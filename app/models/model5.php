<?php
$model = [
    'getData' => function () {
        $json = file_get_contents(__DIR__ . '/../data/data.json');
        return json_decode($json, true);
    },
    'getStats' => function ($data) {
        return $data['stats_globales'];
    },
    'getPromotions' => function ($data) {
        return $data['promotions'];
    },
    // ✅ Ajout de la fonction de recherche
    'searchPromotions' => function ($data, $searchTerm) {
        $promos = $data['promotions'];
        if (empty($searchTerm)) return $promos;

        return array_filter($promos, function ($promo) use ($searchTerm) {
            return stripos($promo['nom'], $searchTerm) !== false;
        });
    }
];
?>
