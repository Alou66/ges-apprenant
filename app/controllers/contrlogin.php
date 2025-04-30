<?php
require_once __DIR__ . '/../models/model2.php';
require_once __DIR__ . '/../services/session.service.php';

/**
 * Vérifie les credentials de l'utilisateur
 */
function verifierCredentials($login, $password) {
    global $model;
    return $model['verifierConnexion']($login, $password);
}

/**
 * Démarre la session et stocke les infos utilisateur
 */
function demarrerSession($user) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['user'] = $user;
}

/**
 * Gère la redirection après connexion selon le profil
 */
function gererRedirection($user) {
    if ($user['profil'] === 'Admin') {
        header('Location: index.php?page=prom');
    } else {
        header('Location: index.php?page=dashboard');
    }
    exit();
}

/**
 * Gère les erreurs de connexion
 */
function gererErreurConnexion() {
    $_SESSION['error'] = "Login ou mot de passe incorrect";
    header('Location: index.php?page=con');
    exit();
}

/**
 * Point d'entrée principal du contrôleur
 */
function handleLogin() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if (!$login || !$password) {
            gererErreurConnexion();
        }

        $user = verifierCredentials($login, $password);
        
        if ($user) {
            demarrerSession($user);
            gererRedirection($user);
        } else {
            gererErreurConnexion();
        }
    }

    // Si pas de POST ou autre cas, afficher le formulaire de connexion
    require __DIR__ . '/../views/connect/login.php';
}

// Exécution du contrôleur
handleLogin();