<?php
// require_once __DIR__ . '/../models/model_affi_liste.php';

// // Récupération des paramètres de filtre depuis l'URL
// $search = isset($_GET['search']) ? trim($_GET['search']) : '';
// $referentiel = isset($_GET['referentiel']) ? trim($_GET['referentiel']) : '';
// $statut = isset($_GET['statut']) ? trim($_GET['statut']) : '';

// // Application des filtres
// $filters = [
//     'search' => $search,
//     'referentiel' => $referentiel,
//     'statut' => $statut
// ];

// // Récupération des promotions filtrées
// $promotions = getPromotions($filters);

// // Vérification que $promotions est bien un tableau
// if (!is_array($promotions)) {
//     $promotions = [];
// }

// // Formatage des dates pour l'affichage
// foreach ($promotions as &$promotion) {
//     if (isset($promotion['date_debut'])) {
//         $promotion['date_debut_formatted'] = date('d/m/Y', strtotime($promotion['date_debut']));
//     }
//     if (isset($promotion['date_fin'])) {
//         $promotion['date_fin_formatted'] = date('d/m/Y', strtotime($promotion['date_fin']));
//     }
// }
// unset($promotion); // Important pour éviter des effets indésirables avec la référence

// // Configuration de la pagination
// $promotionsPerPage = 6; // Nombre de promotions par page
// $currentPage = isset($_GET['currentPage']) ? max(1, (int)$_GET['currentPage']) : 1;
// $totalPromotions = count($promotions);
// $totalPages = ceil($totalPromotions / $promotionsPerPage);

// // Ajustement de la page courante si elle dépasse le total
// if ($currentPage > $totalPages && $totalPages > 0) {
//     $currentPage = $totalPages;
// }

// // Calcul de l'offset pour la pagination
// $offset = ($currentPage - 1) * $promotionsPerPage;
// $paginatedPromotions = array_slice($promotions, $offset, $promotionsPerPage);

// // Récupération de tous les référentiels pour le filtre
// $allReferentiels = getAllReferentiels();

// // Préparation des données pour la vue
// $pagination_data = [
//     'promotions' => $paginatedPromotions,
//     'currentPage' => $currentPage,
//     'totalPages' => $totalPages,
//     'search' => $search,
//     'referentielFilter' => $referentiel,
//     'statutFilter' => $statut,
//     'allReferentiels' => $allReferentiels
// ];

// // Chargement de la vue
// ob_start();
// include __DIR__ . '/../views/vues/vue_liste.php';
// $contenu = ob_get_clean();

// // Inclusion du layout principal
// require __DIR__ . '/../views/layout/base.layout2.php';


require_once __DIR__ . '/../models/model_affi_liste.php';

// Récupération des paramètres de filtre depuis l'URL
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$referentiel = isset($_GET['referentiel']) ? trim($_GET['referentiel']) : '';
$statut = isset($_GET['statut']) ? trim($_GET['statut']) : '';

// Application des filtres
$filters = [
    'search' => $search,
    'referentiel' => $referentiel,
    'statut' => $statut
];

// Récupération des promotions filtrées
$promotions = getPromotions($filters);

// Vérification que $promotions est bien un tableau
if (!is_array($promotions)) {
    $promotions = [];
}

// Formatage des dates pour l'affichage
foreach ($promotions as &$promotion) {
    if (isset($promotion['date_debut'])) {
        $promotion['date_debut_formatted'] = date('d/m/Y', strtotime($promotion['date_debut']));
    }
    if (isset($promotion['date_fin'])) {
        $promotion['date_fin_formatted'] = date('d/m/Y', strtotime($promotion['date_fin']));
    }
}
unset($promotion);

// Configuration de la pagination
$promotionsPerPage = 5;
$currentPage = isset($_GET['currentPage']) ? max(1, (int)$_GET['currentPage']) : 1;
$totalPromotions = count($promotions);
$totalPages = ceil($totalPromotions / $promotionsPerPage);

// Ajustement de la page courante si elle dépasse le total
if ($currentPage > $totalPages && $totalPages > 0) {
    $currentPage = $totalPages;
}

// Pagination
$offset = ($currentPage - 1) * $promotionsPerPage;
$paginatedPromotions = array_slice($promotions, $offset, $promotionsPerPage);

// Récupération de tous les référentiels et des stats
$allReferentiels = getAllReferentiels();
$stats = getStats(); // <-- AJOUT ICI

// Préparation des données pour la vue
$pagination_data = [
    'promotions' => $paginatedPromotions,
    'currentPage' => $currentPage,
    'totalPages' => $totalPages,
    'search' => $search,
    'referentielFilter' => $referentiel,
    'statutFilter' => $statut,
    'allReferentiels' => $allReferentiels,
    'stats' => $stats // <-- AJOUT ICI AUSSI
];

// Chargement de la vue
ob_start();
include __DIR__ . '/../views/vues/vue_liste.php';
$contenu = ob_get_clean();

// Inclusion du layout principal
require __DIR__ . '/../views/layout/base.layout.php';
