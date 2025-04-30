<?php
require_once __DIR__ . '/../models/model5.php';

$data = $model['getData']();
$stats = $model['getStats']($data);
$promotions = $model['getPromotions']($data);

// Recherche
$search = isset($_GET['search']) ? trim(preg_replace('/\s+/', ' ', $_GET['search'])) : '';

if (!empty($search)) {
    $promotions = $model['searchPromotions']($data, $search);
}

// Séparation active et autres promotions
$promotions_actives = array_filter($promotions, function($promo) {
    return !empty($promo['active']);
});

$promotions_non_actives = array_filter($promotions, function($promo) {
    return empty($promo['active']);
});

// Pagination des promotions non actives
$promos_per_page = 5;
$current_page = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
$total_non_actives = count($promotions_non_actives);
$total_pages = max(1, ceil($total_non_actives / $promos_per_page));

$start_index = ($current_page - 1) * $promos_per_page;
$promotions_paginated = array_slice($promotions_non_actives, $start_index, $promos_per_page);

// Fusionner promotion active + promotions de la page
$promotions_finales = array_merge($promotions_actives, $promotions_paginated);

// Statistiques
$promotion_active_count = $stats['promotion_active_count'];
$promotion_total_count = $stats['promotion_total_count'];
$nombre_referentiel = $stats['nombre_referentiel'];
$nombre_apprenants = $stats['nombre_apprenants'];

// Vue
ob_start();
require __DIR__ . '/../views/vues/promotions.php';
$contenu = ob_get_clean();

require __DIR__ . '/../views/layout/base.layout.php';
?>
