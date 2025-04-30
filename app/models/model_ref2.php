<?php

function getReferentielsEtPromotions() {
    $path = __DIR__ . '/../data/data.json';
    $data = json_decode(file_get_contents($path), true);

    // Récupérer les référentiels
    $referentiels = $data['referentiels'] ?? [];

    // Récupérer les promotions actives
    $promotions_actives = array_filter($data['promotions'], function ($promo) {
        return $promo['active'] === true;
    });

    return [$referentiels, $promotions_actives];
}

function ajouterReferentielAPromotions($referentiel_nom, $noms_promos) {
    $path = __DIR__ . '/../data/data.json';
    $data = json_decode(file_get_contents($path), true);

    // Parcourir les promotions et ajouter le référentiel sélectionné
    foreach ($data['promotions'] as &$promo) {
        if (in_array($promo['nom'], $noms_promos) && $promo['active']) {
            // Ajouter le référentiel s'il n'est pas déjà dans la promotion
            if (!in_array($referentiel_nom, $promo['referentiels'])) {
                $promo['referentiels'][] = $referentiel_nom;
            }
        }
    }

    // Sauvegarder les modifications dans le fichier JSON
    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));
}
?>
