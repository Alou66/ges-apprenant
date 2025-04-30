<?php

$model_referentiel = []; // Très important de le déclarer avant d'ajouter les fonctions

// Fonction pour valider les données envoyées par le formulaire
$model_referentiel['validerReferentiel'] = function($data, $files) {
    $erreurs = [];

    if (empty($data['nom'])) {
        $erreurs[] = "Le nom du référentiel est obligatoire.";
    }
    if (empty($data['description'])) {
        $erreurs[] = "La description est obligatoire.";
    }
    if (empty($data['capacite']) || !is_numeric($data['capacite'])) {
        $erreurs[] = "La capacité doit être un nombre.";
    }
    if (empty($data['sessions']) || !is_numeric($data['sessions'])) {
        $erreurs[] = "Le nombre de sessions doit être un nombre.";
    }
    if (!isset($files['photo']) || $files['photo']['error'] !== UPLOAD_ERR_OK) {
        $erreurs[] = "La photo est obligatoire.";
    }
    if (empty($data['module']) || !is_numeric($data['module'])) {
        $erreurs[] = "La module doit être un nombre.";
    }

    return $erreurs;
};

// Fonction pour ajouter un référentiel dans le fichier JSON
$model_referentiel['ajouterReferentiel'] = function($data, $files) {
    $jsonPath = __DIR__ . '/../data/data.json';
    $jsonData = json_decode(file_get_contents($jsonPath), true);

    // Création du nom de fichier unique pour la photo
    $nomFichierOriginal = basename($files['photo']['name']);
    $nomFichier = uniqid('ref_') . '_' . $nomFichierOriginal;

    // Chemin pour stocker la photo
    $cheminWeb = 'assets/images/' . $nomFichier;
    $cheminServeur = realpath(__DIR__ . '/../../public') . '/' . $cheminWeb;

    // Créer le dossier s'il n'existe pas
    $dossierImages = dirname($cheminServeur);
    if (!is_dir($dossierImages)) {
        mkdir($dossierImages, 0755, true);
    }

    // Déplacement de la photo
    if (!move_uploaded_file($files['photo']['tmp_name'], $cheminServeur)) {
        die("Erreur lors du déplacement de l'image. Vérifiez les permissions du dossier 'assets/images'.");
    }

    // Création du nouveau référentiel
    $nouveauReferentiel = [
        'nom' => htmlspecialchars(trim($data['nom'])),
        'description' => htmlspecialchars(trim($data['description'])),
        'nombre_apprenants' => (int) $data['capacite'], // Remarque : nombre_apprenants = capacité
        'nombre_module' => (int) $data['module'], // Remarque : nombre_apprenants = capacité
        'sessions' => (int) $data['sessions'],
        'photo' => $cheminWeb // chemin relatif vers la photo
    ];

    // Ajout du référentiel au JSON
    $jsonData['referentiels'][] = $nouveauReferentiel;
    file_put_contents($jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
};

// À la fin tu retournes ton tableau de fonctions
return $model_referentiel;
