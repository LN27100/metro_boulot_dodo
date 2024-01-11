<?php

// Fonction de connexion à la base de données
function connectToDatabase() {
    $dsn = "mysql:host=localhost;dbname=metro_boulot_dodo";
    $username = "LN27100";
    $password = "02111979Lh#";

    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
        die();
    }
}

// Fonction d'exécution de requête
function executeQuery($db, $sql) {
    $query = $db->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

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

    if (empty($errors)) {
        $db = connectToDatabase();

        // Récupération des données du formulaire
        $nom = trim(htmlspecialchars($_POST['nom']));
        $prenom = trim(htmlspecialchars($_POST['prenom']));
        $pseudo = trim(htmlspecialchars($_POST['pseudo']));
        $date_naissance = trim(htmlspecialchars($_POST['date_naissance']));
        $email = trim(htmlspecialchars($_POST['email']));
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

         // Assurez-vous d'avoir l'identifiant de l'entreprise associée
         $enterprise_name = $_POST["entreprise"];
         $enterprise_id = null;
 
         // Logique pour obtenir l'identifiant de l'entreprise en fonction du nom
         if ($enterprise_name === "plume_futee") {
             $enterprise_id = 1;
         } elseif ($enterprise_name === "dream_stones") {
             $enterprise_id = 2;
         }
 
         if ($enterprise_id !== null) {
             // Requête d'insertion avec enterprise_id
             $sql_insert_user = 'INSERT INTO `userprofil` (`user_name`, `user_firstname`, `user_pseudo`, `user_dateofbirth`, `user_email`, `user_password`, `user_validate`, `enterprise_id`) 
                                 VALUES (?, ?, ?, ?, ?, ?, 0, ?)';
 
             try {
                 $query_insert_user = $db->prepare($sql_insert_user);
                 $query_insert_user->execute([$nom, $prenom, $pseudo, $date_naissance, $email, $mot_de_passe, $enterprise_id]);

                
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
            echo '<p>Entreprise choisie: ' . htmlspecialchars($_POST["entreprise"]) . '</p>';
            echo '<p><strong><em>Vous pouvez maintenant vous connecter.</em></strong></p>';
            echo '<button class="button" style="background-color: #28a745; color: #fff; border: none; border-radius: 5px; padding: 10px 20px; cursor: pointer;">Connexion</button>'; // Style directement dans l'attribut "style"
            echo '</div>';

        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage();
        }
    } else {
        echo "Erreur : Entreprise non reconnue.";
    }
} else {
    // Afficher les erreurs
    print_r($errors);
}
}


// Affichage du formulaire ou des erreurs
if ($_SERVER["REQUEST_METHOD"] != "POST" || !empty($errors)) {
    include_once __DIR__ . '../../views/view-signup.php';
}

// Exécution des requêtes pour récupérer les données de la base de données
$db = connectToDatabase();

$sql_enterprise = 'SELECT * FROM `enterprise`';
$sql_userprofil = 'SELECT * FROM `userprofil`';
$sql_admin = 'SELECT * FROM `admin`';
$sql_events = 'SELECT * FROM `events`';
$sql_ride = 'SELECT * FROM `ride`';
$sql_transport = 'SELECT * FROM `transport`';
$sql_transport_pris_en_compte = 'SELECT * FROM `transport_pris_en_compte`';

// Exécuter la première requête
$query_enterprise = $db->prepare($sql_enterprise);
$query_enterprise->execute();
$result_enterprise = $query_enterprise->fetchAll(PDO::FETCH_ASSOC);

// Exécuter la deuxième requête
$query_userprofil = $db->prepare($sql_userprofil);
$query_userprofil->execute();
$result_userprofil = $query_userprofil->fetchAll(PDO::FETCH_ASSOC);

// Exécuter la troisième requête
$query_admin = $db->prepare($sql_admin);
$query_admin->execute();
$result_admin = $query_admin->fetchAll(PDO::FETCH_ASSOC);

// Exécuter la quatrième requête
$query_events = $db->prepare($sql_events);
$query_events->execute();
$result_events = $query_events->fetchAll(PDO::FETCH_ASSOC);

// Exécuter la cinquième requête
$query_ride = $db->prepare($sql_ride);
$query_ride->execute();
$result_ride = $query_ride->fetchAll(PDO::FETCH_ASSOC);

// Exécuter la sixième requête
$query_transport = $db->prepare($sql_transport);
$query_transport->execute();
$result_transport = $query_transport->fetchAll(PDO::FETCH_ASSOC);

// Exécuter la septième requête
$query_transport_pris_en_compte = $db->prepare($sql_transport_pris_en_compte);
$query_transport_pris_en_compte->execute();
$result_transport_pris_en_compte = $query_transport_pris_en_compte->fetchAll(PDO::FETCH_ASSOC);

// Afficher les résultats 
// var_dump($result_enterprise);

// var_dump($result_userprofil);

// var_dump($result_admin);

// var_dump($result_events);

// var_dump($result_ride);

// var_dump($result_transport);

// var_dump($result_transport_pris_en_compte);

?>