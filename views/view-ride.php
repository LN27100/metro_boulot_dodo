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
    include('../templates/header.php');

    // Bouton de déconnexion
    echo '<a href="../controllers/controller-signout.php" class="buttonHome2">Déconnexion</a>';
    ?>

    <h1 class="titreAccueil">Eco'Mouv !!</h1>

    <div class="container4">
        <?php
        // Date avec le fuseau horaire correct
        $dateActuelle = new DateTime('now', new DateTimeZone('Europe/Paris'));
        echo $dateActuelle->format('d/m/Y');
        ?>
    </div>

    <div class="container4">

        <?php echo "<h3> $pseudo</h3>"; ?>

        <img src="../assets/img/avatarDefault.jpg" alt="avatar par défaut">
    </div>


    <div class="container5">

        <?php echo "<p>Transport utilisé: <span style='color: black;'>  $date</span></p>"; ?>
        <?php echo "<p>Transport utilisé:  <span style='color: black;'>$transport</span></p>"; ?>
        <?php echo "<p>Kilomètres effectués:  <span style='color: black;'>$kilometers</span></p>"; ?>


        <a href="../controllers/controller-home.php" class="returnHome">Accueil</a>


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