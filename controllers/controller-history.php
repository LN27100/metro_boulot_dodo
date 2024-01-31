<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupère l'identifiant de la balade à supprimer depuis le formulaire POST
    $ride_id = isset($_POST['ride_id']) ? intval($_POST['ride_id']) : 0;

    // Vérifie si l'identifiant de la balade est valide (supérieur à 0)
    if ($ride_id > 0) {

        // Inclut les fichiers de configuration et le modèle Ride
        require_once '../config.php';
        require_once __DIR__ . '/../models/Ride.php';

        // Appelle la méthode statique pour supprimer la balade
        Ride::deleteRide($ride_id);
    }

    // Redirige l'utilisateur vers la page d'historique après la suppression
    header("Location: ../controllers/controller-history.php");

    // Termine l'exécution du script pour éviter toute exécution supplémentaire après la redirection
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

// Inclure la vue history uniquement si l'utilisateur est connecté
include_once '../views/view-history.php';
