<?php
/**
 * Fonctions de gestion des promotions et des référentiels
 */

/**
 * Récupère les données depuis le fichier JSON
 * @return array Données complètes du fichier JSON
 */
function getData() {
    $path = __DIR__ . '/../data/data.json';
    if (!file_exists($path)) {
        return [
            'promotions' => [],
            'stats_globales' => [],
            'referentiels' => []
        ];
    }
    
    $json = file_get_contents($path);
    return json_decode($json, true);
}

/**
 * Récupère les promotions avec filtrage optionnel
 * @param array $filters Tableau associatif des filtres à appliquer
 * @return array Liste des promotions filtrées
 */
function getPromotions($filters = []) {
    $data = getData();
    $promotions = $data['promotions'] ?? [];
    
    // Filtrage par recherche
    if (!empty($filters['search'])) {
        $search = strtolower($filters['search']);
        $promotions = array_filter($promotions, function($promo) use ($search) {
            return strpos(strtolower($promo['nom']), $search) !== false;
        });
    }
    
    // Filtrage par référentiel
    if (!empty($filters['referentiel'])) {
        $referentiel = strtolower($filters['referentiel']);
        $promotions = array_filter($promotions, function($promo) use ($referentiel) {
            foreach ($promo['referentiels'] as $ref) {
                if (strtolower($ref) === $referentiel) {
                    return true;
                }
            }
            return false;
        });
    }
    
    // Filtrage par statut
    if (!empty($filters['statut'])) {
        if ($filters['statut'] === 'actives') {
            $promotions = array_filter($promotions, fn($promo) => $promo['active'] === true);
        } elseif ($filters['statut'] === 'inactives') {
            $promotions = array_filter($promotions, fn($promo) => $promo['active'] === false);
        }
    }
    
    return array_values($promotions);
}

/**
 * Récupère les statistiques globales
 * @return array Tableau de fonctions pour récupérer les statistiques
 */
function getStats() {
    $data = getData();
    $stats = $data['stats_globales'] ?? [];
    
    return [
        'total' => fn() => $stats['promotion_total_count'] ?? 0,
        'actives' => fn() => $stats['promotion_active_count'] ?? 0,
        'apprenants' => fn() => $stats['nombre_apprenants'] ?? 0,
        'referentiels' => fn() => $stats['nombre_referentiel'] ?? 0,
        'stagiaires' => fn() => $stats['nombre_stagiaires'] ?? 0,
        'permanents' => fn() => $stats['nombre_permanents'] ?? 0

    ];
}

/**
 * Récupère tous les référentiels disponibles
 * @return array Liste des noms de référentiels uniques
 */
function getAllReferentiels() {
    $data = getData();
    $referentiels = [];
    
    // Ajouter les référentiels depuis la liste principale
    foreach ($data['referentiels'] ?? [] as $ref) {
        if (isset($ref['nom'])) {
            $referentiels[] = $ref['nom'];
        }
    }
    
    // Ajouter les référentiels utilisés dans les promotions
    foreach ($data['promotions'] ?? [] as $promo) {
        if (isset($promo['referentiels']) && is_array($promo['referentiels'])) {
            foreach ($promo['referentiels'] as $ref) {
                $referentiels[] = $ref;
            }
        }
    }
    
    // Éliminer les doublons et retourner le tableau
    return array_unique($referentiels);
}