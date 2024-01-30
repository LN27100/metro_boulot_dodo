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

            $uploadFile = $uploadDir . basename($_FILES['profile_image']['name']);

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
        header("Location: ../controllers/controller-profil.php");

        try {
            Userprofil::updateProfil($user_id, $new_description, $new_name, $new_firstname, $new_pseudo, $new_email, $new_dateofbirth);
            $_SESSION['user']['user_describ'] = $new_description;
            $_SESSION['user']['user_name'] = $new_name;
            $_SESSION['user']['user_firstname'] = $new_firstname;
            $_SESSION['user']['user_pseudo'] = $new_pseudo;
            $_SESSION['user']['user_email'] = $new_email;
            $_SESSION['user']['user_dateofbirth'] = $new_dateofbirth;

        } catch (Exception $e) {
            echo "Erreur lors de la mise à jour du profil : " . $e->getMessage();
        }
    }
}

$allEnterprises = Enterprise::getAllEnterprises();

include_once '../views/view-profil.php';
?>