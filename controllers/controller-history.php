<?php
// Assurez-vous de valider et sécuriser vos données avant de les utiliser
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ride_id = isset($_POST['ride_id']) ? intval($_POST['ride_id']) : 0;

    if ($ride_id > 0) {
        require_once '../config.php';
        require_once __DIR__ . '/../models/Ride.php';

        Ride::deleteRide($ride_id);
    }

    // Redirigez l'utilisateur vers la page history après la suppression
    header("Location: chemin/vers/votre/controller-history.php");
    exit();
}

// Le reste de votre code pour récupérer les trajets
if (session_status() === PHP_SESSION_NONE) {
    // Si non, démarrer la session
    session_start();
}

require_once '../config.php';
require_once __DIR__ . '/../models/Ride.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: chemin/vers/votre/controller-signin.php");
    exit();
}

// Récupère l'ID de l'utilisateur depuis la session
$user_id = isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : null;

// Vérifie si l'ID de l'utilisateur est défini
if ($user_id === null) {
    header("Location: chemin/vers/votre/controller-home.php");
    exit();
}

// Récupère le pseudo de l'utilisateur
$pseudo = isset($_SESSION['user']['user_pseudo']) ? ($_SESSION['user']['user_pseudo']) : "Pseudo non défini";

// Appelle la méthode getAllTrajets en passant l'ID de l'utilisateur
$allTrajets = Ride::getAllTrajets($user_id);

// Inclure la vue history uniquement si l'utilisateur est connecté
include_once '../views/view-history.php';
?>