<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../config.php';
require_once '../models/Userprofil.php';

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
$date_naissance = isset($_SESSION['user']['user_dateofbirth']) ? ($_SESSION['user']['user_dateofbirth']) : "Date de naissance non défini";
$email = isset($_SESSION['user']['user_email']) ? ($_SESSION['user']['user_email']) : "Email non défini";
$entreprise = isset($_SESSION['user']['enterprise_id']) ? Userprofil::getEntrepriseNom($_SESSION['user']['enterprise_id']) : "Entreprise non définie";
$img = isset($_SESSION['user']['user_photo']) ? ($_SESSION['user']['user_photo']) : "Photo non défini";

// Gestion de la mise à jour de l'image de profil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_image'])) {
    // Ajoutez ces lignes pour afficher les erreurs
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $uploadDir = '../assets/uploads/';

    // Vérifier et créer le dossier si nécessaire
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uploadFile = $uploadDir . basename($_FILES['profile_image']['name']);

    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFile)) {
        // Mettez à jour le chemin de l'image dans la session et la base de données
        $_SESSION['user']['user_photo'] = $uploadFile;
        Userprofil::updateProfileImage($_SESSION['user']['user_id'], $uploadFile);
    } else {
        echo "Erreur lors du téléchargement du fichier : " . $_FILES['profile_image']['error'];
    }

}

include_once '../views/view-profil.php';
?>