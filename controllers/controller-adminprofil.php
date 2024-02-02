<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../config.php';
require_once '../models/Admin.php';

// Vérifie si l'administrateur est connecté
if (!isset($_SESSION['admin'])) {
    // Redirigez vers la page de connexion si l'administrateur n'est pas connecté
    header("Location: ../controllers/controller-adminsignin.php");
    exit();
}

// Récupère le pseudo de l'administrateur
$email = isset($_SESSION['admin']['admin_email']) ? ($_SESSION['admin']['admin_email']) : "Email non défini";

// Gestion du formulaire
$errors = array(); // Tableau pour stocker les erreurs

$admin_id = isset($_SESSION['admin']['admin_id']) ? $_SESSION['admin']['admin_id'] : null;



    
    // Gestion du formulaire
    if (isset($_POST['save_modification'])) {
        $admin_id = isset($_SESSION['admin']['admin_id']) ? $_SESSION['admin']['admin_id'] : 0;
        $new_email = isset($_POST['user_email']) ? ($_POST['user_email']) : "";

        // Contrôle de l'email 
            if (empty($_POST["user_email"])) {
                $errors["user_email"] = "Champ obligatoire";
            } elseif (!filter_var($_POST["user_email"], FILTER_VALIDATE_EMAIL)) {
                $errors["user_email"] = "Le format de l'adresse email n'est pas valide";
            } elseif (Admin::checkMailExists($_POST["user_email"]) && $_POST ["user_email"] != $_SESSION["user"]["user_email"]){
                $errors["user_email"] = 'Mail déjà utilisé';
            }


        // Si des erreurs sont détectées, redirigez l'utilisateur vers le formulaire avec les erreurs
        if (empty($errors)) {
            try {
                Admin::updateProfil($admin_id, $new_email);
                $_SESSION['admin']['admin_email'] = $new_email;
            } catch (Exception $e) {
                echo "Erreur lors de la mise à jour du profil : " . $e->getMessage();
            }

            // Redirigez l'utilisateur vers la page du profil après la mise à jour
            header("Location: ../controllers/controller-adminprofil.php");
            exit();
        }
    }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_profile'])) {
            // Appelle la méthode pour supprimer le profil
            $delete_result = Admin::deleteAdmin($admin_id);
        
            if ($delete_result === true) {
                // Suppression réussie, redirigez vers la page d'accueil avec un message de succès
                header("Location: ../adminsignin.php?message=Redirection+reussie");
                exit();
            } else {
                echo "Erreur lors de la suppression du profil : " . $delete_result;
                exit();
            }
        }



include_once '../views/view-adminprofil.php';
