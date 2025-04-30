<?php
$modele = require __DIR__ . '/../models/model3.php';

$search = $_POST['search_ref'] ?? '';
$referentiels = $modele['getReferentielsPromoActive']($search);

ob_start();
require __DIR__ . '/../views/vues/referentiels.php';
$contenu = ob_get_clean();

require __DIR__ . '/../views/layout/base.layout.php';
