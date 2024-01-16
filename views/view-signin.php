<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    <title>Connexion</title>
</head>

<body>
    <h1>Veuillez vous connecter</h1>
    <?php
        if ($showform) {
        ?>

    <form>
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Email: </label>
            <input type="email" id="form2Example1" class="form-control" />
            <div class="invalid-feedback" id="emailValidationFeedback">
            </div>
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example2">Mot de passe :</label>
            <input type="password" id="form2Example2" class="form-control" />
            <div class="invalid-feedback" id="passwordValidationFeedback">Champ obligatoire</div>

        </div>


        <div class="col">
            <a href="#!">Mot de passe perdu?</a>
        </div>
        </div>

        <a href="../controllers/controller-home.php" type="button" class="button btn-block mb-4">Connexion</a>

        <div class="text-center">
            <p>Pas encore membre? <a href="../controllers/controller-signup.php">Inscrivez-vous!</a></p>
            

        </div>
    </form>

    <?php } else { ?>
        <p>ACCUEIL</p>
            <?php } ?>




</body>

</html>