<?php

//lier le fichier config
require_once '../config.php';
require_once '../models/Userprofil.php';

// VERIFICATION DE LA SOUMISSION DU FORMULAIRE
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

     // Récupération des données du formulaire en le rendant "safe" (enlever les caractères spéciaux etc)
     $nom = trim(htmlspecialchars($_POST['nom']));
     $prenom = trim(htmlspecialchars($_POST['prenom']));
     $pseudo = trim(htmlspecialchars($_POST['pseudo']));
     $date_naissance = trim(htmlspecialchars($_POST['date_naissance']));
     $email = trim(htmlspecialchars($_POST['email']));
     $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
     $enterprise_id = $_POST['entreprise'];


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
    } elseif (!preg_match("/^[a-zA-ZÀ-ÿ\d]+$/", $_POST["pseudo"])) {
        $errors["pseudo"] = "Seules les lettres et les chiffres sont autorisés dans le champ Pseudo";
    } elseif (strlen($_POST["pseudo"]) < 6) {
        $errors["pseudo"] = "Le pseudo doit contenir au moins 6 caractères";
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

    // On s'assure qu'il n'y a pas d'erreur dans le formuaire
    if (empty($errors)) {

    Userprofil::create ($nom, $prenom, $pseudo, $date_naissance, $email, $mot_de_passe, $enterprise_id, 1);

                echo '<style>';
                echo 'body {';
                echo '  background-color: #7A9855;';
                echo '}';
                echo 'h2 {';
                echo '  background-color: #D7C5A8;';
                echo '  color: white;';
                echo '  padding: 10px;';
                echo '  width: 20rem;';
                echo '  margin: 0 auto; /* Utilisation de la marge pour centrer horizontalement */';
                echo '}';
                echo '.button {';
                echo '  background-color: #206D3C;';
                echo '  color: #fff;';
                echo '  border: none;';
                echo '  border-radius: 5px;';
                echo '  padding: 10px 20px;';
                echo '  cursor: pointer;';
                echo '}';
                echo '.button:hover {';
                echo '  background-color: #B5CA69 ;';
                echo '}';
                echo '</style>';

                echo '<div style="text-align: center;">';
                echo "<h2>Inscription réussie</h2>";
                echo "<h3>Données soumises :</h3>";
                echo "<p>Nom : " . $nom . "</p>";
                echo "<p>Prénom : " . $prenom . "</p>";
                echo "<p>Pseudo : " . $pseudo . "</p>";
                echo "<p>Date de naissance : " . $date_naissance . "</p>";
                echo "<p>Email : " . $email . "</p>";
                echo "<p>Mot de passe reçu</p>";
                echo '<p>Entreprise choisie: ' . htmlspecialchars($_POST["entreprise"]) . '</p>';
                echo '<p><strong><em>Vous pouvez maintenant vous connecter.</em></strong></p>';
                echo '<button class="button">Connexion</button>';
                echo '</div>';
           
}




// RECUPERATION DES DONNEES DE LA BDD

$sql_enterprise = 'SELECT * FROM `enterprise`';
$sql_transport = 'SELECT * FROM `transport`';

// REQUETE DE RECUPERATION
// on prépare la requête
$query_enterprise = $db->prepare($sql_enterprise);
// on exécute la requête
$query_enterprise->execute();
// On stocke le résultat dans un tableau
$result_enterprise = $query_enterprise->fetchAll(PDO::FETCH_ASSOC);

$query_transport = $db->prepare($sql_transport);
$query_transport->execute();
$result_transport = $query_transport->fetchAll(PDO::FETCH_ASSOC);


// Afficher les résultats 
// var_dump($result_enterprise);
// Donne toutes les propriétés du serveur
// var_dump($_SERVER)
}


// Affichage du formulaire ou des erreurs
if ($_SERVER["REQUEST_METHOD"] != "POST" || !empty($errors)) {
    include_once __DIR__ . '../../views/view-signup.php';
}

?>


<!-- LEXIQUE ET EXPLICATIONS UTILES -->

<!-- trim(): Cette fonction en PHP est utilisée pour supprimer les espaces (ou d'autres caractères spécifiés) du début et de la fin d'une chaîne. Cela est utile pour nettoyer les éventuels espaces en trop qui pourraient être saisis accidentellement. -->

<!-- htmlspecialchars(): Cette fonction PHP est utilisée pour convertir certains caractères spéciaux en entités HTML équivalentes. Cela est fait pour éviter les attaques par injection de code. Par exemple, si quelqu'un saisit du code HTML ou JavaScript malveillant dans le champ 'nom', cette fonction va convertir les caractères spéciaux en entités HTML, rendant le code inoffensif lorsqu'il est affiché dans une page web. -->

<!-- PDO, qui signifie PHP Data Objects, est une extension de PHP qui fournit une interface uniforme pour accéder à différentes bases de données.
Permet aux développeurs de travailler avec différentes bases de données sans avoir à modifier significativement leur code. Vous pouvez changer de SGBD simplement en ajustant la chaîne de connexion (DSN) sans toucher au reste du code.
Support multi-bases de données : PDO prend en charge plusieurs types de bases de données, notamment MySQL, PostgreSQL, SQLite, MS SQL Server, Oracle, et d'autres. Cela rend PDO particulièrement utile pour les projets qui pourraient éventuellement être déployés sur différentes plateformes de bases de données. -->

<!-- password_hash(): C'est une fonction de hachage sécurisée intégrée à PHP. Elle prend en entrée le mot de passe que vous souhaitez hacher et génère une version hachée sécurisée à stocker en base de données. -->

<!-- PASSWORD_DEFAULT: C'est une constante utilisée comme coût de hachage pour la fonction password_hash. Cette constante représente l'algorithme de hachage recommandé par défaut au moment de la mise à jour de PHP. Elle garantit que la méthode de hachage utilisée est à jour avec les meilleures pratiques de sécurité. -->