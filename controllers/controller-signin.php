<?php
// Lier le fichier config
require_once '../config.php';
require_once '../models/Userprofil.php';

// récupération info utilisateur
// $myArray = Userprofil::getInfos('poirier.helene@outlook.fr');
// var_dump($myArray);

$showform = true;
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire en les rendant "safe" (enlever les caractères spéciaux, etc.)
    $email = trim(htmlspecialchars($_POST['email']));
    $mot_de_passe = $_POST['mot_de_passe'];

    // Contrôle de l'email 
    if (empty($_POST["email"])) {
        $errors["email"] = "Le champ Courriel ne peut pas être vide";
    }
    // Contrôle du mot de passe
    if (empty($_POST["mot_de_passe"])) {
        $errors["mot_de_passe"] = "Le champ Mot de passe ne peut pas être vide";
    }

    if (empty($errors)) {
        // Vérifier les identifiants de l'utilisateur
        $userProfile = Userprofil::checkMailExists($email, $mot_de_passe);

        if ($userProfile) {
            // L'utilisateur existe et les identifiants sont corrects
            $showform = false;

            // Rediriger vers la page d'accueil (ou toute autre page appropriée)
            header("Location: ../controllers/controller-home.php");
            exit(); // Assurez-vous de terminer le script après la redirection
        } else {
            // L'utilisateur n'existe pas ou les identifiants sont incorrects
            $errors["connexion"] = "Adresse email ou mot de passe incorrect";
        }
    }
}

include_once '../views/view-signin.php';
?>