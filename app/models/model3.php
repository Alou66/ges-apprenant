<?php
return [
    'getPromotionActive' => function () {
        $filePath = __DIR__ . '/../data/data.json';
        if (!file_exists($filePath)) return null;

        $data = json_decode(file_get_contents($filePath), true);
        foreach ($data['promotions'] ?? [] as $promo) {
            if (!empty($promo['active'])) return $promo;
        }
        return null;
    },

    'getReferentielsPromoActive' => function ($search = '') {
        $filePath = __DIR__ . '/../data/data.json';
        if (!file_exists($filePath)) return [];

        $data = json_decode(file_get_contents($filePath), true);
        $promos = $data['promotions'] ?? [];

        foreach ($promos as $promo) {
            if (!empty($promo['active'])) {
                $refPromo = $promo['referentiels'] ?? [];

                return array_filter($data['referentiels'] ?? [], function ($ref) use ($refPromo, $search) {
                    return in_array($ref['nom'], $refPromo) &&
                        (empty($search) || stripos($ref['nom'], $search) !== false);
                });
            }
        }

        return [];
    }
];
