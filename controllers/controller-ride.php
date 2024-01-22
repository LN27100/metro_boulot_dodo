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
// Récupère le pseudo de l'utilisateur
$pseudo = isset($_SESSION['user']['user_pseudo']) ? ($_SESSION['user']['user_pseudo']) : "Pseudo non défini";
$transport = isset($_SESSION['user']['transport_id']) ? isset($_SESSION['user']['transport_id']) : "Transport non défini";
$date = isset($_SESSION['user']['ride_date']) ? isset($_SESSION['user']['ride_date']) : "Date non défini";
$kilometers = isset($_SESSION['user']['ride_distance']) ? isset($_SESSION['user']['ride_distance']) : "Kilomètres non défini";

// Inclure la vue home uniquement si l'utilisateur est connecté
include_once '../views/view-ride.php';
?>