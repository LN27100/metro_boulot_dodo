<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <title>Accueil Admin Eco'Mouv</title>
</head>

<body>



    <h1 class="titreAccueil">Eco'Mouv Admin !!</h1>

    <div class="container4">
        <?php
        // Date avec le fuseau horaire correct
        $dateActuelle = new DateTime('now', new DateTimeZone('Europe/Paris'));
        echo $dateActuelle->format('d/m/Y');
        ?>
    </div>

    <div class="container4">
        <h3>Bienvenue</h3>
        </div>

        <div class="global">
        <div class="container4">

        <img src="/assets/img/avatarDefault.jpg" alt="photo de profil" class="imageHome">
    </div>

    <div class="container4">
        <a href="#" class="buttonadminhome">Valider les entreprises</a>
    </div>

    <div class="container4">
        <a href="#" class="buttonadminhome">Valider les utilisateurs</a>
    </div>
    </div>

    <div class="container6">
        <a href="../controllers/controller-adminhome.php" class="buttonNav"><i class="bi bi-house"></i>
            Accueil</a>
        <a href="../controllers/controller-adminprofil.php" class="buttonNav"><i class="bi bi-person"></i>
            Profil</a>
        
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

