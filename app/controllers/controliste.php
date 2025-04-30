<?php


// Inclure la vue
ob_start();
require __DIR__ . '/../views/vues/vue_liste.php';
$contenu = ob_get_clean();

require __DIR__ . '/../views/layout/base.layout2.php';