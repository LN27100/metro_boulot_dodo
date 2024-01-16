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
    <div class="container">
        <?php
        if ($showform) {
        ?>
            <form class="row" method="POST" action="../controllers/controller-signin.php" novalidate>


                <div class="form-group col-md-6">
                    <label for="email" class="form-label">Email : </label>
                    <input type="email" class="form-control <?php if (isset($errors['email'])) echo 'is-invalid'; ?>" id="validationServer01" name="email" placeholder="adresse email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
                    <div class="invalid-feedback" id="emailValidationFeedback">
                        <?php
                        if (isset($errors['email'])) {
                            echo $errors['email'];
                        } else {
                            echo "Champ obligatoire";
                        }
                        ?>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="password-input" class="form-label">Mot de passe: </label>
                    <div class="input-group d-flex">
                        <input type="password" class="form-control rounded mt-1 password-input <?php if (isset($errors['mot_de_passe'])) echo 'is-invalid'; ?>" name="mot_de_passe" placeholder="Votre mot de passe" aria-label="password" aria-describedby="password" id="password-input">
                        <div class="invalid-feedback" id="passwordValidationFeedback">Champ obligatoire</div>
                    </div>
                </div>


                <div class="col">
                    <a href="#">Mot de passe perdu?</a>
                </div>


                <div class="text-center">
                    <button class="button" type="submit" id="submitButton">Se connecter</button>
                </div>


                <div class="text-center">
                    <p>Pas encore membre? <a href="../controllers/controller-signup.php">Inscrivez-vous!</a></p>

                </div>
    </div>
    </form>

<?php } else { ?>
    <p>ACCUEIL</p>
<?php } ?>

<script>
    function toggleValidity(inputElement, feedbackElement) {
        var inputValue = inputElement.value;

        // Vérifier la validité de l'entrée
        if (filter_var(inputValue, FILTER_VALIDATE_EMAIL)) {
            inputElement.classList.remove("is-invalid");
            inputElement.classList.add("is-valid");
            feedbackElement.classList.remove("invalid-feedback");
            feedbackElement.classList.add("valid-feedback");
            feedbackElement.innerText = "Email valide";
            feedbackElement.style.display = "block";
        } else {
            inputElement.classList.remove("is-valid");
            inputElement.classList.add("is-invalid");
            feedbackElement.classList.remove("valid-feedback");
            feedbackElement.classList.add("invalid-feedback");
            feedbackElement.innerText = "Email non valide";
            feedbackElement.style.display = "block";
        }
    }

    const emailInput = document.getElementById("validationServer01");
    const emailFeedback = document.getElementById("emailValidationFeedback");

    emailInput.addEventListener("input", function() {
        toggleValidity(emailInput, emailFeedback);
    });
</script>

</body>

</html>