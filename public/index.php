<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../app/route/route.web.php';  // Inclusion des routes

$page = $_GET['page'] ?? 'con';  // Page par défaut si 'page' n'est pas défini dans l'URL

if ($page === "con") {
    require $route["contrlogin"]();
}

if ($page === "prom") {
    require $route["controlproms2"]();  // pas utile si tu n'utilises pas ce nom
}

if ($page === "proms2") {
    require $route["controliste"]();  // corriger ici
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $page === 'login') {
    require $route["contrlogin"]();
}

if ($page === "ref") {
    require $route["controlref"]();
}

if ($page === "ref2") {
    require $route["controlref2"]();
}

if ($page === "proms1") {
    require $route["controlproms1"]();
}

if ($page === "activ"){
    require $route["controlproms2"]();
}

if ($page === "mdp_oublie") {
    require $route["controlmdpoublie"]();
}

if ($page === "deconnexion") {
    require $route["controldeconnexion"]();
}

if ($page === "ajoutpromo") {
    require $route["controlajoutpromo"]();
}

if ($page === "ajoutref") {
    require $route["controlajoutref"]();
}

if ($page === "ajoutref2") {
    require $route["controlajoutref2"]();
}
?>
