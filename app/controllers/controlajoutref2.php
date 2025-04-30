<?php
require_once __DIR__ . '/../models/model_ref2.php';

$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $referentiel = $_POST['libelle'] ?? '';
    $promos = $_POST['promos'] ?? [];

    if (!empty($referentiel) && !empty($promos)) {
        ajouterReferentielAPromotions($referentiel, $promos);
        $success = "Référentiel ajouté avec succès.";
    } else {
        $success = "Veuillez sélectionner un référentiel et au moins une promotion.";
    }
}

list($referentiels, $promotions_actives) = getReferentielsEtPromotions();

// Capture du contenu de la vue
ob_start();
require __DIR__ . '/../views/vues/ajout_ref2.php';
$contenu = ob_get_clean();

// Intégration dans le layout centralisé
require __DIR__ . '/../views/layout/base.layout.php';
?>
