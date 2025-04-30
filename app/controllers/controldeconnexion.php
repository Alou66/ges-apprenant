<?php
require_once __DIR__ . '/../services/session.service.php';

// Appeler la fonction logout qui gère la déconnexion
logout();

// Rediriger vers la page de connexion avec des en-têtes no-cache
header("Location: index.php?page=con");
exit();