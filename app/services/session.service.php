<?php
session_start();

function logout() {
    // Détruire toutes les variables de session
    $_SESSION = array();
    
    // Détruire le cookie de session
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-3600, '/');
    }
    
    // Détruire la session
    session_destroy();
    
    // Empêcher la mise en cache des pages
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    
    // Empêcher la navigation avec le bouton précédent
    header("Clear-Site-Data: \"cache\", \"cookies\", \"storage\"");
    
    // Rediriger vers la page de connexion
    header("Location: index.php?page=con");
    exit();
}