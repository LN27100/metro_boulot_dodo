<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    <title>Modifier votre profil</title>
</head>

<body>


    <!-- Formulaire de modification du profil (masqué par défaut) -->
    <form method="post" action="../controllers/controller-updateprofil.php" class="transparent-form" enctype="multipart/form-data" id="editDescriptionForm" style="display: none;">
    <div class="profile-info">
        <p class="styleProfil">Modifier votre description:</p>
        <textarea id="user_describ" name="user_describ" rows="5" cols="33"><?= isset($_SESSION['user']['user_describ']) ? ($_SESSION['user']['user_describ']) : "" ?></textarea>
    </div>

    <div class="profile-info">
        <p><span class="styleProfil"> Nom:</span></p>
        <input type="text" name="user_name" placeholder="Nouveau nom" value="<?= $nom ?>">

        <p><span class="styleProfil"> Prénom:</span></p>
        <input type="text" name="user_firstname" placeholder="Nouveau prénom" value="<?= $prenom ?>">

        <p><span class="styleProfil"> Pseudo:</span></p>
        <input type="text" name="user_pseudo" placeholder="Nouveau pseudo" value="<?= $pseudo ?>">

        <p><span class="styleProfil"> Email:</span></p>
        <input type="text" name="user_email" placeholder="Nouveau email" value="<?= $email ?>">

        <p><span class="styleProfil"> Date de naissance:</span></p>
        <input type="date" name="user_dateofbirth" placeholder="Nouvelle date de naissance" value="<?= $date_naissance ?>">
    </div>

    <div class="profile-info">
        <input type="submit" name="save_modification" value="Enregistrer" class="file-input-button">
        <button type="button" id="cancelEditBtn" class="file-input-button">Annuler</button>
    </div>
</form>

    <div class="container6">
        <a href="../controllers/controller-home.php" class="buttonNav"><i class="bi bi-house"></i>
            Accueil</a>
        <a href="../controllers/controller-profil.php" class="buttonNav"><i class="bi bi-person"></i>
            Profil</a>
        <a href="../controllers/controller-history.php" class="buttonNav"><i class="bi bi-clock-history"></i>
            Historique</a>
    </div>

    <script>
      
    </script>

</body>

</html>