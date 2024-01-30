<?php
// Empêche l'accès à la page home si l'utilisateur n'est pas connecté et vérifie si la session n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    // Si non, démarrer la session
    session_start();
}

require_once '../config.php';
require_once __DIR__ . '/../models/Ride.php';
require_once __DIR__ . '/../models/Transport.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: ../controllers/controller-signin.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    // Récupération des données du formulaire en le rendant "safe" (enlever les caractères spéciaux etc)
    $date = trim($_POST['dateStart']);
    $distance = trim($_POST['kilometers']);
    $user_id = trim($_SESSION['user']['user_id']);
    $transport_id = ($_POST['transport_id']);
    $ride_time = trim($_POST['ride_time']);


 

    // Contrôle du date
    if (empty($_POST["dateStart"])) {
        $errors["dateStart"] = "Champ obligatoire";
    } 

    // Contrôle du kilometers
    if (empty($_POST["kilometers"])) {
        $errors["kilometers"] = "Champ obligatoire";
    } 

    // Contrôle transport_id
    if (empty($_POST["transport_id"])) {
        $errors["transport_id"] = "Champ obligatoire";
    }

     // Contrôle transport_id
     if (empty($_POST["ride_time"])) {
        $errors["time_id"] = "Champ obligatoire";
    }
    // On s'assure qu'il n'y a pas d'erreur dans le formuaire
    if (empty($errors)) {

        Ride::create( $date,  $transport_id,  $distance, $ride_time,  $user_id);
        header("Location: ../controllers/controller-history.php?trajetAdded=true");

    }

    // Donne toutes les propriétés du serveur
    // var_dump($_SERVER)
}
// Récupèration données
$pseudo = isset($_SESSION['user']['user_pseudo']) ? ($_SESSION['user']['user_pseudo']) : "Pseudo non défini";
$allTransports = Transport::getAllTransports();
$img = isset($_SESSION['user']['user_photo']) ? ($_SESSION['user']['user_photo']) : "Photo non définie";


// Inclure la vue home uniquement si l'utilisateur est connecté
include_once '../views/view-ride.php';
?>