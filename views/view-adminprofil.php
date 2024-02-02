<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <title>Votre profil</title>
</head>

<body>
    <?php

    // Bouton de déconnexion
    echo '<a href="../controllers/controller-adminsignout.php" class="buttonHome2"><i class="fa-solid fa-power-off"></i>

    </a>';
    ?>

    <h1 class="titreAccueil">Eco'Mouv !!</h1>

    <h2 class="tittleProfil">Profil administrateur</h1>

        <div class="container3">
            <div class="adminprofil-image-container">
                <img src="../assets/img/avatarDefault.jpg" alt="photo de profil" class="adminprofil-image">
            </div>

            <div class="adminprofil-info">

                <p><span class="styleProfil">Email: </span> <?= $email ?></p>
            </div>

            <div class="contnair">
                <button id="editDescriptionBtn">Modifier le profil</button>

                <form action="../controllers/controller-adminprofil.php" method="post" class="deleteProfil">
                    <input type="hidden" name="delete_profile" value="<?= $admin_id ?>">
                    <button class="delete_profile" type="submit" name="delete_profile" onclick="return confirm('Voulez-vous vraiment supprimer ce profil ?')">Supprimer le profil</button>
                </form>
            </div>
        </div>

        <div class="container6">
            <a href="../controllers/controller-adminhome.php" class="buttonNav"><i class="bi bi-house"></i>
                Accueil</a>
            <a href="../controllers/controller-adminprofil.php" class="buttonNav"><i class="bi bi-person"></i>
                Profil</a>
        </div>

        <!-- Formulaire de modification du profil (masqué par défaut) -->
        <form method="post" action="../controllers/controller-adminprofil.php" class="transparent-form" enctype="multipart/form-data" id="editDescriptionForm" style="display: none;">


                <p><span class="styleProfil">Email:</span></p>
                <input type="text" name="admin_email" placeholder="Nouveau email" value="<?= $email ?>">

                <!-- Affichage des erreurs pour l'email -->
                <?php if (isset($errors['admin_email'])) { ?>
                    <span class="error-message"><?= $errors['admin_email']; ?></span>
                <?php } ?>


                <div class="profile-info">
                    <input type="submit" name="save_modification" value="Enregistrer" class="file-input-button">
                    <button type="button" id="cancelEditBtn" class="file-input-button">Annuler</button>
                </div>
        </form>



        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const navbarToggle = document.getElementById("navbar-toggle");
                const navbarNav = document.getElementById("navbar-nav");

                if (navbarToggle && navbarNav) {
                    navbarToggle.addEventListener("click", function() {
                        navbarNav.classList.toggle("active");
                    });
                }

                document.getElementById('editDescriptionBtn').addEventListener('click', function() {
                    // Masquer la div avec la classe profile-info
                    document.querySelector('.adminprofil-info').style.display = 'none';
                    // Afficher le formulaire de modification
                    document.getElementById('editDescriptionForm').style.display = 'block';
                });

                // Afficher le formulaire de modification si des erreurs sont présentes
                if (<?= !empty($errors) ? 'true' : 'false' ?>) {
                    document.getElementById('editDescriptionForm').style.display = 'block';
                    document.querySelector('.adminprofil-info').style.display = 'none';
                }

                document.getElementById('cancelEditBtn').addEventListener('click', function() {
                    // Afficher à nouveau la div avec la classe adminprofil-info
                    document.querySelector('.adminprofil-info').style.display = 'block';
                    // Masquer le formulaire de modification
                    document.getElementById('editDescriptionForm').style.display = 'none';
                });
            });
        </script>


</body>

</html>