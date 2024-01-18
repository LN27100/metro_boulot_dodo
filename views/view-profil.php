<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    <title>Votre profil</title>
</head>

<body>

    <?php include('../templates/header.php'); ?>

    <h1 class="titreAccueil">Votre profil</h1>
    <div class="container3">

    <?php
        // empêche l'accès à la page home si l'utilisateur n'est pas connecté et vérifie si la session n'est pas déjà active
        if (session_status() === PHP_SESSION_NONE) {
            // Si non, démarrer la session
            session_start();
        }

    
        if (isset($_SESSION['pseudo'])) {
            $pseudo = $_SESSION['pseudo'];
            echo "<p>Pseudo: $pseudo</p>";
        } else {
            echo "<p>Pseudo non défini</p>";
        }
    
        if (isset($_SESSION['nom'])) {
            $nom = $_SESSION['nom'];
            echo "<p>Nom: $nom</p>";
        } else {
            echo "<p>Nom non défini</p>";
        }
    
        if (isset($_SESSION['prenom'])) {
            $prenom = $_SESSION['prenom'];
            echo "<p>Prénom: $prenom</p>";
        } else {
            echo "<p>Prénom non défini</p>";
        }
    
        if (isset($_SESSION['date_naissance'])) {
            $date_naissance = $_SESSION['date_naissance'];
            echo "<p>Date de naissance: $date_naissance</p>";
        } else {
            echo "<p>Date de naissance non définie</p>";
        }
    
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            echo "<p>Email: $email</p>";
        } else {
            echo "<p>Email non défini</p>";
        }
    
    
    ?>

    <a href="../controllers/controller-home.php" class="returnHome">Accueil</a>
    </div>
    <script>
  
</script>
</body>

</html>
