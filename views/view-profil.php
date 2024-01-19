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

    <?php echo "<img src='" . $img . "' alt='photo de profil'>"; ?>
    <?php echo "<p>Nom: $nom</p>"; ?>
    <?php echo "<p>Prenom: $prenom</p>"; ?>
    <?php echo "<p>Pseudo: $pseudo</p>"; ?>
    <?php echo "<p>Date de naissance: $date_naissance</p>"; ?>
    <?php echo "<p>Email: $email</p>"; ?>
    <?php echo "<p>Entreprise de challenges: $entreprise</p>"; ?>



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
