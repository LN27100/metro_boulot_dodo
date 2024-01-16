<?php

$showform = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    // Récupération des données du formulaire en le rendant "safe" (enlever les caractères spéciaux etc)
    
    $email = trim(htmlspecialchars($_POST['email']));
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);


    // Contrôle de l'email
    if (empty($_POST["email"])) {
        $errors["email"] = "Le champ Courriel ne peut pas être vide";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Le format de l'adresse email n'est pas valide";
    }


    // Contrôle du mot de passe
    if (empty($_POST["mot_de_passe"])) {
        $errors["mot_de_passe"] = "Le champ Mot de passe ne peut pas être vide";
    } elseif (strlen($_POST["mot_de_passe"]) < 8) {
        $errors["mot_de_passe"] = "Le mot de passe doit contenir au moins 8 caractères";
    }

    

    // On s'assure qu'il n'y a pas d'erreur dans le formuaire
    if (empty($errors)) {

        $showform = false;
    }

    // Donne toutes les propriétés du serveur
    // var_dump($_SERVER)
}

include_once  '../views/view-signin.php';

//lier le fichier config
require_once '../config.php';
require_once '../models/Userprofil.php';



?>