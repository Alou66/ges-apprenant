<?php

function chargerJson()
{
    $chemin = __DIR__ . '/../data/data.json';
    $contenu = file_get_contents($chemin);
    return json_decode($contenu, true);
}

function enregistrerJson($data)
{
    $chemin = __DIR__ . '/../data/data.json';
    file_put_contents($chemin, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function validerNomUnique($nom, $promotions)
{
    foreach ($promotions as $promo) {
        if (strtolower($promo['nom']) === strtolower($nom)) {
            return false;
        }
    }
    return true;
}

function validerPhoto($photo)
{
    if (!isset($photo) || $photo['error'] !== UPLOAD_ERR_OK) return "Erreur d'upload de la photo";

    $typeAutorise = ['image/jpeg', 'image/png'];
    $tailleMax = 2 * 1024 * 1024; // 2MB

    if (!in_array($photo['type'], $typeAutorise)) {
        return "Format non autorisé (JPG ou PNG uniquement)";
    }

    if ($photo['size'] > $tailleMax) {
        return "Taille dépassée (max 2MB)";
    }

    return true;
}

function enregistrerPhoto($photo)
{
    $nomFichier = uniqid() . "_" . basename($photo['name']);
    $cheminWeb = 'assets/images/' . $nomFichier;
    $cheminAbsolu = realpath(__DIR__ . '/../../public') . '/' . $cheminWeb;

    if (!is_dir(dirname($cheminAbsolu))) {
        mkdir(dirname($cheminAbsolu), 0755, true);
    }

    if (!move_uploaded_file($photo['tmp_name'], $cheminAbsolu)) {
        die("Erreur lors du déplacement de l'image. Vérifiez les permissions du dossier 'assets/images'.");
    }

    return $cheminWeb;
}

function getReferentielsActifs($json)
{
    $actifs = [];
    foreach ($json['promotions'] as $promo) {
        if ($promo['active']) {
            foreach ($promo['referentiels'] as $ref) {
                if (!in_array($ref, $actifs)) {
                    $actifs[] = $ref;
                }
            }
        }
    }
    return $actifs;
}

function ajouterPromotion($post, $fichier)
{
    $json = chargerJson();

    $nom = trim($post['nom']);
    $date_debut = $post['date_debut'] ?? '';
    $date_fin = $post['date_fin'] ?? '';
    $referentiels = $post['referentiels'] ?? [];

    $erreurs = [];

    if (!$nom || !$date_debut || !$date_fin || empty($referentiels)) {
        $erreurs[] = "Tous les champs sont obligatoires.";
    }

    if (!validerNomUnique($nom, $json['promotions'])) {
        $erreurs[] = "Nom de promotion déjà utilisé.";
    }

    // Validation des dates
    try {
        $dateDebut = new DateTime($date_debut);
        $dateFin = new DateTime($date_fin);
        if ($dateDebut > $dateFin) {
            $erreurs[] = "La date de début doit être antérieure ou égale à la date de fin.";
        }
    } catch (Exception $e) {
        $erreurs[] = "Format de date invalide.";
    }

    $validPhoto = validerPhoto($fichier['photo']);
    if ($validPhoto !== true) {
        $erreurs[] = $validPhoto;
    }

    if (!empty($erreurs)) {
        return $erreurs;
    }

    $photoPath = enregistrerPhoto($fichier['photo']);

    $nouvellePromo = [
        'nom' => $nom,
        'date_debut' => $date_debut,
        'date_fin' => $date_fin,
        'photo' => $photoPath,
        'nombre_apprenants' => 0,
        'active' => false,
        'referentiels' => $referentiels
    ];

    $json['promotions'][] = $nouvellePromo;
    $json['stats_globales']['promotion_total_count']++;

    enregistrerJson($json);

    return true;
}
