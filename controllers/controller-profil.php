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
    // indique à PHP de signaler toutes les erreurs
    error_reporting(E_ALL);
    // autorise l'affichage des erreurs directement dans la sortie de la page web pendant le développement pour repérer et résoudre les erreurs.
    ini_set('display_errors', 1);
    
    $uploadDir = '../assets/uploads/';

    // Vérification du dossier de sauvegarde des images
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uploadFile = $uploadDir . basename($_FILES['profile_image']['name']);

    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFile)) {
        $_SESSION['user']['user_photo'] = $uploadFile;
        Userprofil::updateProfileImage($_SESSION['user']['user_id'], $uploadFile);
    } else {
        echo "Erreur lors du téléchargement du fichier : " . $_FILES['profile_image']['error'];
    }
    

// Enregistrement et mise à jour de la description
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_description'])) {
    $user_id = isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : 0;
    $new_description = isset($_POST['user_describ']) ? htmlspecialchars($_POST['user_describ']) : "";
    
    try {
        Userprofil::updateProfilDescrib($user_id, $new_description);
        $_SESSION['user']['user_describ'] = $new_description; 
    } catch (Exception $e) {
        echo "Erreur lors de la mise à jour de la description : " . $e->getMessage();
    }
}
}

include_once '../views/view-profil.php';
?>