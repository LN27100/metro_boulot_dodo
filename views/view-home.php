<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    <title>Accueil Eco'Mouv</title>
</head>

<body>

    <?php


    include('../templates/header.php'); ?>

    <button class="buttonHome2" type="button">Déconnexion</button>

    <h1 class="titreAccueil">Eco'Mouv !!</h1>

    <div class="container3">
        <?php
        // Date avec le fuseau horaire correct
        $dateActuelle = new DateTime('now', new DateTimeZone('Europe/Paris'));
        echo $dateActuelle->format('d/m/Y');
        ?>
    </div>

    <div class="container3">

        <?php echo "<h3>Bienvenue $pseudo</h3>"; ?>

        <img src="../assets/img/avatarDefault.jpg" alt="avatar par défaut">
    </div>

    <div class="container3">
        <button class="buttonHome">Commencer un trajet</button>

        <button class="buttonHome">Historique des tajets</button>
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

<!-- LEXIQUE -->
<!-- exit(); est une mesure de sécurité pour s'assurer qu'aucun code supplémentaire n'est exécuté après une redirection, ce qui pourrait potentiellement causer des problèmes ou générer un contenu non désiré dans la réponse HTTP. -->