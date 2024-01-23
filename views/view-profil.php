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
    <?php

    // Bouton de déconnexion
    echo '<a href="../controllers/controller-signout.php" class="buttonHome2">Déconnexion</a>';
    ?>
    <?php include('../templates/header.php'); ?>

    <h1 class="titreAccueil">Votre profil</h1>
    <div class="container3">

        <?php echo "<img src='" . $img . "' alt='photo de profil'>"; ?>
        <?php echo "<p>Nom: <span style='color: black;'>$nom</span></p>"; ?>
        <?php echo "<p>Prenom: <span style='color: black;'>$prenom</span></p>"; ?>
        <?php echo "<p>Pseudo: <span style='color: black;'>$pseudo</span></p>"; ?>
        <?php echo "<p>Date de naissance:<span style='color: black;'>$date_naissance</span></p>"; ?>
        <?php echo "<p>Email: <span style='color: black;'>$email</span></p>"; ?>
        <?php echo "<p>Entreprise: <span style='color: black;'>$entreprise</span></p>"; ?>



    </div>

    <div class="container6">
    <a href="../controllers/controller-home.php" class="buttonNav">Accueil</a>
    <a href="../controllers/controller-profil.php" class="buttonNav">Profil</a>
    <a href="#" class="buttonNav">Historique</a>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navbarToggle = document.getElementById("navbar-toggle");
            const navbarNav = document.getElementById("navbar-nav");

            navbarToggle.addEventListener("click", function() {
                navbarNav.classList.toggle("active");
            });
        });
    </script>
</body>

</html>