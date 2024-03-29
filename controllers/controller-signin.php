<?php
require_once '../config.php';
require_once '../models/Userprofil.php';


// empêche l'accès à la page home si l'utilisateur n'est pas connecté et vérifie si la session n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    // Si non, démarrer la session
    session_start();
}


// Vérifiez si un formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tableau d'erreurs (stockage des erreurs)
    $errors = [];

    // Vérifiez si l'email est vide
    if (empty($_POST["email"])) {
        $errors["email"] = "Champ obligatoire";
    } else {
        // Récupérez la valeur de l'email depuis le formulaire
        $email = $_POST["email"];
    }

    // Vérifiez si le mot de passe est vide
    if (empty($_POST["mot_de_passe"])) {
        $errors["mot_de_passe"] = "Champ obligatoire";
    }


    if (isset($_POST["g-recaptcha-response"])) {
        // print_r($_POST);
        $secret = '6LcPI3EpAAAAAAiT_WAJYuLsDrpmyYvSBmFjIxCa';
        $reponse = $_POST['g-recaptcha-response'];
        $remoteip = $_SERVER['REMOTE_ADDR'];

        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$reponse&remoteip=$remoteip ";

        $reponseData = file_get_contents($url);
        $dataRow = json_decode($reponseData, true);

        // print_r($dataRow);

        if (!$dataRow['success'] == true) {
            $errors['recaptcha'] = 'Recaptcha obligatoire';
        }
    }

    // Si aucune erreur, procédez à la vérification de l'utilisateur
    if (empty($errors)) {
        // Vérifiez si l'email existe dans la base de données
        if (!Userprofil::checkMailExists($email)) {
            $errors['email'] = 'Utilisateur Inconnu';
        }

        // Récupérez les informations de l'utilisateur
        $utilisateurInfos = Userprofil::getInfos($email);

        // Bloquer la connexion si l'utilisateur a été suspendu
        if ($utilisateurInfos['user_validate'] == 0) {
            echo '<div style="color: red; font-weight: bold; text-align: center; margin-top: 1rem">Votre compte a été suspendu temporairement</div>';
        } else {


            // Comparaison du mot de passe
            if (password_verify($_POST["mot_de_passe"], $utilisateurInfos['user_password'])) {
                // Mot de passe correct

                // Stockez les infos dans la variable de session
                $_SESSION['user'] = $utilisateurInfos;

                // Redirigez vers la page d'accueil
                header("Location: ../controllers/controller-home.php");
                exit();
            } else {
                $errors['mot_de_passe'] = 'Mauvais mot de passe';
            }
        }
    }
}



// Inclure la vue du formulaire de connexion
include_once '../views/view-signin.php';


// LEXIQUE

// "session_start()" démarre une nouvelle session ou reprend une session existante. Elle doit être appelée avant tout accès aux variables de session ou avant tout contenu HTML dans le script. Permet de maintenir une session active pour un utilisateur sur plusieurs pages

// la vérification en haut $_SESSION assure que les utilisateurs déjà connectés sont redirigés vers la page d'accueil (header location) plutôt que de voir à nouveau la page de connexion.