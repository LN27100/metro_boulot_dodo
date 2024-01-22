<?php
// Empêche l'accès à la page home si l'utilisateur n'est pas connecté et vérifie si la session n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    // Si non, démarrer la session
    session_start();
}

require_once '../config.php';
require_once __DIR__ . '/../models/Ride.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: ../controllers/controller-signin.php");
    exit();
}
var_dump($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    // Récupération des données du formulaire en le rendant "safe" (enlever les caractères spéciaux etc)
    $transport = trim($_POST['transport']);
    $date = trim($_POST['date']);
    $kilometers = trim($_POST['kilometers']);
    $user_id = trim($_POST['user_id']);
    $transport_id = trim($_POST['transport_id']);



    // Contrôle du transport
    if (empty($_POST["transport"])) {
        $errors["transport"] = "Champ obligatoire";
    } 

    // Contrôle du date
    if (empty($_POST["date"])) {
        $errors["date"] = "Champ obligatoire";
    } 

    // Contrôle du kilometers
    if (empty($_POST["kilometers"])) {
        $errors["kilometers"] = "Champ obligatoire";
    } 

    // Contrôle user_id
    if (empty($_POST["user_id"])) {
        $errors["user_id"] = "Champ obligatoire";
    } 

    // Contrôle transport_id
    if (empty($_POST["transport_id"])) {
        $errors["transport_id"] = "Champ obligatoire";
    }

    // On s'assure qu'il n'y a pas d'erreur dans le formuaire
    if (empty($errors)) {

        Userprofil::create($nom, $prenom, $pseudo, $date_naissance, $email, $mot_de_passe, $enterprise_id, 1);
        Ride::create($transport, $date, $kilometers, $user_id, $transport_id);

        $showform = false;
        
    }

    // Donne toutes les propriétés du serveur
    // var_dump($_SERVER)
}
// Récupèration données
$pseudo = isset($_SESSION['user']['user_pseudo']) ? ($_SESSION['user']['user_pseudo']) : "Pseudo non défini";
$transport = isset($_SESSION['user']['transport_id']) ? isset($_SESSION['user']['transport_id']) : "Transport non défini";
$date = isset($_SESSION['user']['ride_date']) ? isset($_SESSION['user']['ride_date']) : "Date non défini";
$kilometers = isset($_SESSION['user']['ride_distance']) ? isset($_SESSION['user']['ride_distance']) : "Kilomètres non défini";
$user_id = isset($_SESSION['user']['user_id']) ? isset($_SESSION['user']['user_id']) : "Kilomètres non défini";
$transport_id = isset($_SESSION['user']['transport_id']) ? isset($_SESSION['user']['transport_id']) : "Kilomètres non défini";

// Inclure la vue home uniquement si l'utilisateur est connecté
include_once '../views/view-ride.php';
?>