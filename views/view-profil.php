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
    echo '<a href="../controllers/controller-signout.php" class="buttonHome2"><i class="bi bi-box-arrow-left"></i>
    </a>';
    ?>
    <?php include('../templates/header.php'); ?>

    <h1 class="titreAccueil">Votre profil</h1>

    <div class="container3">
    <div class="profile-image-container">
    <img src="<?= $img ?>" alt="photo de profil" class="profile-image">
    <form method="post" action="../controllers/controller-profil.php" enctype="multipart/form-data" class="file-input-container">
        <label for="profile_image" class="file-label">Choisir un fichier</label>
        <input type="file" name="profile_image" id="profile_image" required>
        <input type="submit" value="Télécharger">
    </form>
</div>

        <div class="profile-info">
            <p><span class="styleProfil"> Nom:</span> <?= $nom ?></p>
            <p><span class="styleProfil">Prenom: </span> <?= $prenom ?></p>
            <p><span class="styleProfil">Pseudo:</span> <?= $pseudo ?></p>
            <p><span class="styleProfil">Date de naissance: </span> <?= $date_naissance ?></p>
            <p><span class="styleProfil">Email: </span> <?= $email ?></p>
            <p><span class="styleProfil">Entreprise:</span><?= $entreprise ?></p>
        </div>
    </div>

    <div class="container6">
        <a href="../controllers/controller-home.php" class="buttonNav"><i class="bi bi-house"></i>
            Accueil</a>
        <a href="../controllers/controller-profil.php" class="buttonNav"><i class="bi bi-person"></i>
            Profil</a>
        <a href="../controllers/controller-history.php" class="buttonNav"><i class="bi bi-clock-history"></i>
            Historique</a>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navbarToggle = document.getElementById("navbar-toggle");
            const navbarNav = document.getElementById("navbar-nav");

            if (navbarToggle && navbarNav) {
                navbarToggle.addEventListener("click", function() {
                    navbarNav.classList.toggle("active");
                });
            }
        });

        function updateFileName() {
            var input = document.getElementById('formFile');
            var fileNameInput = document.getElementById('fileName');

            if (input.files.length > 0) {
                fileNameInput.value = input.files[0].name;
            } else {
                fileNameInput.value = '';
            }
            
        }
    </script>
</body>

</html>