<?php
$model = require __DIR__ . '/../models/model_mdp_oublie.php';

function updatePassword($login, $newPassword, $data) {
    foreach ($data['utilisateurs'] as &$u) {
        if ($u['nom'] === $login) {
            $u['mot_de_passe'] = $newPassword;
            break;
        }
    }
    return $data;
}

function handlePasswordReset($login, $newPassword, $confirmPassword) {
    if ($newPassword === $confirmPassword) {
        $file = __DIR__ . '/../data/data.json';
        $data = json_decode(file_get_contents($file), true);
        
        $updatedData = updatePassword($login, $newPassword, $data);
        file_put_contents($file, json_encode($updatedData, JSON_PRETTY_PRINT));
        
        header('Location: index.php?page=con');
        exit;
    }
    return "Les deux mots de passe sont différents.";
}

function verifyUser($login, $model) {
    $user = $model["findUserByLogin"]($login);
    if ($user) {
        return ["message" => "Utilisateur trouvé. Veuillez entrer un nouveau mot de passe.", "found" => true];
    }
    return ["message" => "Utilisateur non trouvé.", "found" => false];
}

// Point d'entrée principal
function handlePasswordResetRequest() {
    global $model;
    
    $message = "";
    $showPasswordChangeForm = false;
    $login = $_POST['login'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['new_password'], $_POST['confirm_password'])) {
            $message = handlePasswordReset(
                $login,
                $_POST['new_password'],
                $_POST['confirm_password']
            );
            $showPasswordChangeForm = true;
        } else {
            $result = verifyUser($login, $model);
            $message = $result["message"];
            $showPasswordChangeForm = $result["found"];
        }
    }

    return [
        'message' => $message,
        'showPasswordChangeForm' => $showPasswordChangeForm,
        'login' => $login
    ];
}

// Exécution et affichage
$pageData = handlePasswordResetRequest();
extract($pageData);
require __DIR__ . '/../views/vues/mdp_oublie.php';