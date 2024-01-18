<?php
require_once '../config.php';
require_once '../models/Userprofil.php';

// Nous déclenchons nos vérifications uniquement lorsqu'un submit de type POST est détecté
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // tableau d'erreurs (stockage des erreurs)
    $errors = [];

    if (empty($_POST["email"])) {
        $errors["email"] = "Champ obligatoire";
    } else {
        // Récupérer la valeur de l'email depuis le formulaire
        $email = $_POST["email"];
    }

    if (empty($_POST["mot_de_passe"])) {
        $errors["mot_de_passe"] = "Champ obligatoire";
    }

    if (empty($errors)) {
        // ici commence les tests

        if (!Userprofil::checkMailExists($email)) {
            $errors['email'] = 'Utilisateur Inconnu';
        } else {
            $utilisateurInfos = Userprofil::getInfos($email);

            
            // Comparaison du mot de passe
            if (password_verify($_POST["mot_de_passe"], $utilisateurInfos['user_password'])) {
                // Mot de passe correct
                header("Location: ../controllers/controller-home.php");
                exit();
            } else {

                $errors['mot_de_passe'] = 'Mauvais mot de passe';
            }
        }
    }
}

include_once '../views/view-signin.php';
