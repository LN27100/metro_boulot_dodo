<?php

//lier le fichier config
require_once '../config.php';
require_once '../models/Admin.php';


// permet d'afficher le formulaire
$showform = true;

// VERIFICATION DE LA SOUMISSION DU FORMULAIRE
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    // Récupération des données du formulaire en le rendant "safe" (enlever les caractères spéciaux etc)
    $email = trim($_POST['email']);
    $mot_de_passe = trim($_POST['mot_de_passe']);



    // Contrôle de l'email
    if (empty($_POST["email"])) {
        $errors["email"] = "Champ obligatoire";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Le format de l'adresse email n'est pas valide";
    } elseif (Admin::checkMailExists($_POST["email"])) {
        $errors["email"] = 'mail déjà utilisé';
    }

    // Contrôle du mot de passe
    if (empty($_POST["mot_de_passe"])) {
        $errors["mot_de_passe"] = "Champ obligatoire";
    } elseif (strlen($_POST["mot_de_passe"]) < 8) {
        $errors["mot_de_passe"] = "Le mot de passe doit contenir au moins 8 caractères";
    }

    // Contrôle de la confirmation du mot de passe
    if ($_POST["mot_de_passe"] !== $_POST["conf_mot_de_passe"]) {
        $errors["conf_mot_de_passe"] = "Les mots de passe ne correspondent pas";
    }


    // Contrôle des CGU
    if (empty($_POST["cgu"]) || $_POST["cgu"] !== "on") {
        $errors["cgu"] = "Veuillez accepter les conditions générales d'utilisation pour continuer.";
    }

    // On s'assure qu'il n'y a pas d'erreur dans le formuaire
    if (empty($errors)) {

        Admin::create($email, $mot_de_passe);
        $showform = false;

    }


}




// Affichage du formulaire ou des erreurs
include_once __DIR__ . '/../views/view-adminsignup.php';


?>

