<?php 
$route = [
    'controleur' => function() {
        return __DIR__ . '/../controllers/controller.php';
    },
    'contrlogin' => function() {
        return __DIR__ . '/../controllers/contrlogin.php';
    },
    'controlref' => function() {
        return __DIR__ . '/../controllers/controlref.php';
    },
    'controlref2' => function() {
        return __DIR__ . '/../controllers/controlref2.php';
    },
    'controlproms1' => function() {
        return __DIR__ . '/../controllers/controlproms1.php';
    },
    'controlproms2' => function() {
        return __DIR__ . '/../controllers/controlproms2.php';
    },
    'controlmdpoublie' => function() {
        return __DIR__ . '/../controllers/control_mdp_oublie.php';
    },
    'controldeconnexion' => function() {
        return __DIR__ . '/../controllers/controldeconnexion.php';
    },
    'controlajoutpromo' => function () {
        return __DIR__ . '/../controllers/controlajoutpromo.php';
    },
    'controlajoutref' => function () {
        return __DIR__ . '/../controllers/controlajoutref.php';
    },
    'controlajoutref2' => function () {
        return __DIR__ . '/../controllers/controlajoutref2.php';
    },
    // ✅ nouvelle clé pour liste des promotions
    'controliste' => function () {
        return __DIR__ . '/../controllers/control_affi_liste.php';
    }
];
