<?php

// VERIFICATION DE LA SOUMISSION DU FORMULAIRE
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    // Contrôle du nom
    if (empty($_POST["nom"])) {
        $errors["nom"] = "Le champ Nom ne peut pas être vide";
    } elseif (!preg_match("/^[a-zA-ZÀ-ÿ -]*$/", $_POST["nom"])) {
        $errors["nom"] = "Seules les lettres, les espaces et les tirets sont autorisés dans le champ Nom";
    }

    // Contrôle du prénom
    if (empty($_POST["prenom"])) {
        $errors["prenom"] = "Le champ Prénom ne peut pas être vide";
    } elseif (!preg_match("/^[a-zA-ZÀ-ÿ -]*$/", $_POST["prenom"])) {
        $errors["prenom"] = "Seules les lettres, les espaces et les tirets sont autorisés dans le champ Prénom";
    }

    // Contrôle du pseudo
    if (empty($_POST["pseudo"])) {
        $errors["pseudo"] = "Le champ Pseudo ne peut pas être vide";
    } elseif (!preg_match("/^[a-zA-ZÀ-ÿ -]*$/", $_POST["pseudo"])) {
        $errors["pseudo"] = "Seules les lettres, les espaces et les tirets sont autorisés dans le champ Pseudo";
    }

    // Contrôle de l'email
    if (empty($_POST["email"])) {
        $errors["email"] = "Le champ Courriel ne peut pas être vide";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Le format de l'adresse email n'est pas valide";
    }

    // Contrôle de la date de naissance
    if (empty($_POST["date_naissance"])) {
        $errors["date_naissance"] = "Le champ Date de naissance ne peut pas être vide";
    }

    // Contrôle du mot de passe
    if (empty($_POST["mot_de_passe"])) {
        $errors["mot_de_passe"] = "Le champ Mot de passe ne peut pas être vide";
    } elseif (strlen($_POST["mot_de_passe"]) < 8) {
        $errors["mot_de_passe"] = "Le mot de passe doit contenir au moins 8 caractères";
    }

    // Contrôle de la confirmation du mot de passe
    if ($_POST["mot_de_passe"] !== $_POST["conf_mot_de_passe"]) {
        $errors["conf_mot_de_passe"] = "Les mots de passe ne correspondent pas";
    }

        // Contrôle du choix de l'entreprise
        if (empty($_POST["entreprise"])) {
            $errors["entreprise"] = "Veuillez choisir une entreprise";
        }

    // Contrôle des CGU
    if (empty($_POST["cgu"]) || $_POST["cgu"] !== "on") {
        $errors["cgu"] = "Veuillez accepter les conditions générales d'utilisation pour continuer.";
    }

    // Si aucune erreur, traiter les données et soumettre le formulaire
    if (empty($errors)) {

        // VERIFICATION si les CGU sont acceptées
        $cguAccepted = isset($_POST["cgu"]) && $_POST["cgu"] === "on";

        if ($cguAccepted) {

            // RECUPERATION des données du formulaire
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $pseudo = $_POST["pseudo"];
            $date_naissance = $_POST["date_naissance"];
            $email = $_POST["email"];
            $mot_de_passe = $_POST["mot_de_passe"];
            $entreprise = $_POST["entreprise"];

            echo '<div style="text-align: center;">';
            echo '<style>';
            echo 'h2 {';
            echo '  background-color: #93c47d;';
            echo '  color: white;';
            echo '  padding: 10px;';
            echo '  width: 20rem;';
            echo '  margin: 0 auto; /* Utilisation de la marge pour centrer horizontalement */';
            echo '}';
            echo '</style>';
            echo "<h2>Inscription réussie</h2>";
            echo "<h3>Données soumises :</h3>";
            echo "<p>Nom : " . $nom . "</p>";
            echo "<p>Prénom : " . $prenom . "</p>";
            echo "<p>Pseudo : " . $pseudo . "</p>";
            echo "<p>Date de naissance : " . $date_naissance . "</p>";
            echo "<p>Email : " . $email . "</p>";
            // Affichage de la confirmation de mot de passe (on masque le mot de passe)
            echo "<p>Mot de passe reçu</p>";
            echo "<p>Entreprise choisie: " . htmlspecialchars($entreprise) . "</p>";
            echo '<p><strong><em>Vous pouvez maintenant vous connecter.</em></strong></p>';
            echo '<button class="button" style="background-color: #28a745; color: #fff; border: none; border-radius: 5px; padding: 10px 20px; cursor: pointer;">Connexion</button>'; // Style directement dans l'attribut "style"
            echo '</div>';
        }
    } else {
        // Si les CGU ne sont pas acceptées, ajoute une erreur spécifique pour les CGU
        $errors["cgu"] = "Veuillez accepter les conditions générales d'utilisation pour continuer.";
    }
}

// AFFICHER le formulaire si il est vide et ne l'affiche pas quand il est soumis
if ($_SERVER["REQUEST_METHOD"] != "POST" || !empty($errors)) {
    include_once __DIR__ . '../../views/view-signup.php';
}


try {
    // connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=metro_boulot_dodo', 'LN27100', '02111979Lh#');
    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}