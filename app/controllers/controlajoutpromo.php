<?php
require_once __DIR__ . '/../models/model_promo.php';

// Fonctions du contrôleur
function handleFormSubmission() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        return ajouterPromotion($_POST, $_FILES);
    }
    return [];
}

function getReferentiels() {
    return getReferentielsActifs(chargerJson());
}

// Exécution du contrôleur
$erreurs = [];
$succes = false;

$resultat = handleFormSubmission();

if ($resultat === true) {
    $succes = true;
} elseif (is_array($resultat)) {
    $erreurs = $resultat;
}

$referentielsActifs = getReferentiels();

// Capture du contenu de la vue
ob_start();
require __DIR__ . '/../views/vues/ajout_promotion.php';
$contenu = ob_get_clean();

require __DIR__ . '/../views/layout/base.layout.php';
