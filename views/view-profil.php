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

        <img src= "<?= $img ?>" alt="photo de profil">
       <p><span class="styleProfil"> Nom:</span> <?= $nom?></p>
       <p><span class="styleProfil">Prenom: </span> <?= $prenom?></p>
       <p><span class="styleProfil">Pseudo:</span> <?= $pseudo?></p>
       <p><span class="styleProfil">Date de naissance: </span> <?= $date_naissance?></p>
       <p><span class="styleProfil">Email: </span> <?= $email?></p>
       <p><span class="styleProfil">Entreprise:</span><?=  $entreprise?></p>



    </div>

    <div class="container6">
    <a href="../controllers/controller-home.php" class="buttonNav">Accueil</a>
    <a href="../controllers/controller-profil.php" class="buttonNav">Profil</a>
    <a href="../controllers/controller-history.php" class="buttonNav">Historique</a>
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