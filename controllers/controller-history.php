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

// Récupère l'ID de l'utilisateur depuis la session
$user_id = isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : null;

// Vérifie si l'ID de l'utilisateur est défini
if ($user_id === null) {
   
    header("Location: ../controllers/controller-home.php");
    exit();
}

// Récupère le pseudo de l'utilisateur
$pseudo = isset($_SESSION['user']['user_pseudo']) ? ($_SESSION['user']['user_pseudo']) : "Pseudo non défini";

// Appelle la méthode getAllTrajets en passant l'ID de l'utilisateur
$allTrajets = Ride::getAllTrajets($user_id);
// Appelle de la méthode updateRide pour modifier un trajet
// Ride::updateRide($ride_id, $new_date, $new_distance, $new_ride_time, $new_transport_id, $new_user_id);

// Inclure la vue history uniquement si l'utilisateur est connecté
include_once '../views/view-history.php';
?>