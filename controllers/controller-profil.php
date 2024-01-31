<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../config.php';
require_once '../models/Userprofil.php';
require_once '../models/Enterprise.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: ../controllers/controller-signin.php");
    exit();
}

// Récupère le pseudo de l'utilisateur
$pseudo = isset($_SESSION['user']['user_pseudo']) ? ($_SESSION['user']['user_pseudo']) : "Pseudo non défini";
$nom = isset($_SESSION['user']['user_name']) ? ($_SESSION['user']['user_name']) : "Nom non défini";
$prenom = isset($_SESSION['user']['user_firstname']) ? ($_SESSION['user']['user_firstname']) : "Prénom non défini";
$date_naissance = isset($_SESSION['user']['user_dateofbirth']) ? ($_SESSION['user']['user_dateofbirth']) : "Date de naissance non définie";
$email = isset($_SESSION['user']['user_email']) ? ($_SESSION['user']['user_email']) : "Email non défini";
$entreprise = isset($_SESSION['user']['enterprise_id']) ? Userprofil::getEntrepriseNom($_SESSION['user']['enterprise_id']) : "Entreprise non définie";
$img = isset($_SESSION['user']['user_photo']) ? ($_SESSION['user']['user_photo']) : "Photo non définie";

// Gestion du formulaire
$errors = array(); // Tableau pour stocker les erreurs

$user_id = isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : null;

$allEnterprises = Enterprise::getAllEnterprises();

include_once '../views/view-profil.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_profile'])) {
        // Appelle la méthode pour supprimer le profil
        $delete_result = Userprofil::deleteUser($user_id);

        if ($delete_result === true) {
            // Redirige l'utilisateur vers la page d'inscription si la suppression est réussiee
            header("Location: controllers/controller-profil.php");
            exit();
        } else {
            echo "Erreur lors de la suppression du profil : " . $delete_result;
        }
    }}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gestion de la mise à jour de l'image de profil
    if (isset($_FILES['profile_image'])) {
        try {
            // Dossier de sauvegarde des images
            $uploadDir = '../assets/uploads/';

            // Vérification du dossier de sauvegarde des images
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $file_extension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
            // Construire un nom de fichier unique en combinant "profile_", l'ID de l'utilisateur et l'extension du fichier
            $new_file_name = "profile_" . $_SESSION['user']['user_id'] . "." . $file_extension;

            // Construire le chemin complet du fichier en concaténant le dossier de sauvegarde avec le nouveau nom de fichier
            $uploadFile = $uploadDir . $new_file_name;

            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFile)) {
                $_SESSION['user']['user_photo'] = $uploadFile;
                Userprofil::updateProfileImage($_SESSION['user']['user_id'], $uploadFile);
                header("Location: ../controllers/controller-profil.php");
            } else {
                echo "Erreur lors du téléchargement du fichier : " . $_FILES['profile_image']['error'];
            }
        } catch (Exception $e) {
            echo "Erreur lors de la mise à jour de l'image de profil : " . $e->getMessage();
        }
    }


    // Enregistrement et mise à jour du profil
    if (isset($_POST['save_modification'])) {
        $user_id = isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : 0;
        $new_description = isset($_POST['user_describ']) ? ($_POST['user_describ']) : "";
        $new_name = isset($_POST['user_name']) ? ($_POST['user_name']) : "";
        $new_firstname = isset($_POST['user_firstname']) ? ($_POST['user_firstname']) : "";
        $new_pseudo = isset($_POST['user_pseudo']) ? ($_POST['user_pseudo']) : "";
        $new_email = isset($_POST['user_email']) ? ($_POST['user_email']) : "";
        $new_dateofbirth = isset($_POST['user_dateofbirth']) ? ($_POST['user_dateofbirth']) : "";
        $new_enterprise = isset($_POST['new_enterprise']) ? ($_POST['new_enterprise']) : "";

        // Vérification du pseudo
        if (!preg_match("/^[a-zA-ZÀ-ÿ\d]+$/", $new_pseudo)) {
            $errors["pseudo"] = "Seules les lettres et les chiffres sont autorisés dans le champ Pseudo";
        } elseif (strlen($new_pseudo) < 6) {
            $errors["pseudo"] = "Le pseudo doit contenir au moins 6 caractères";
        } elseif (Userprofil::checkPseudoExists($new_pseudo)) {
            $errors["pseudo"] = 'Pseudo déjà utilisé';
        }

        // Vérification de l'email
        if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Le format de l'adresse email n'est pas valide";
        } elseif (Userprofil::checkMailExists($new_email)) {
            $errors["email"] = 'Mail déjà utilisé';
        }


        if (!empty($errors)) {
            include_once '../views/view-profil.php';
            exit();
        }

        try {
            Userprofil::updateProfil(
                $user_id,
                $new_description,
                $new_name,
                $new_firstname,
                $new_pseudo,
                $new_email,
                $new_dateofbirth,
                $new_enterprise
            );

            // Mettez à jour les informations de session
            $_SESSION['user']['user_describ'] = $new_description;
            $_SESSION['user']['user_name'] = $new_name;
            $_SESSION['user']['user_firstname'] = $new_firstname;
            $_SESSION['user']['user_pseudo'] = $new_pseudo;
            $_SESSION['user']['user_email'] = $new_email;
            $_SESSION['user']['user_dateofbirth'] = $new_dateofbirth;
            $_SESSION['user']['enterprise_id'] = $new_enterprise;

            // Redirigez l'utilisateur vers la page du profil après la mise à jour
            header("Location: ../controllers/controller-profil.php");
            exit();
        } catch (Exception $e) {
            echo "Erreur lors de la mise à jour du profil : " . $e->getMessage();
        }
    }
}


?>
