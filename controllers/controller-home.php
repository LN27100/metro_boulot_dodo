<?php

// empêche l'accès à la page home si l'utilisateur n'est pas connecté et vérifie si la session n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    // Si non, démarrer la session
    session_start();
}
require_once '../config.php';
require_once __DIR__ . '/../models/Userprofil.php';

$pseudo = $_SESSION['pseudo'];

// Inclure la vue home uniquement si l'utilisateur est connecté
include_once '../views/view-home.php';
?>