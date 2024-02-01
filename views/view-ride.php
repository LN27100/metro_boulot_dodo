<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <title>Accueil Eco'Mouv</title>
</head>

<body>

    <h1 class="titreAccueil">Eco'Mouv !!</h1>
    <h2 class="tittleProfil">Ajouter un trajet</h1>


    <form class="container" method="POST" action="../controllers/controller-ride.php" novalidate>

        <div class="container4">
            <?php
            // Date avec le fuseau horaire correct
            $dateActuelle = new DateTime('now', new DateTimeZone('Europe/Paris'));
            echo $dateActuelle->format('d/m/Y');
            ?>
        </div>

        <div class="container4">

            <?php echo "<h3> $pseudo</h3>"; ?>

            <img src="<?= $img ?>" alt="photo de profil" class="imageHome">
        </div>


        <div class="container5">
            <div class="container7">
                <label for="dateStart" class="form-label2">Date</label>
                <input type="date" id="dateStart" name="dateStart" required>
                <div class="invalid-feedback" id="dateValidationFeedback">

                </div>
            </div>

            <div class="container7">
                <label for="transptransport_id" class="form-labels">Moyen de transport</label>
                <select class="form-select" aria-label="Default select example" name="transport_id" id="transport">
                    <option value="" selected>Sélectionnez un transport</option>

                    <?php foreach ($allTransports as $transport) {
                    ?>

                        <option value=<?= $transport['transport_id'] ?>> <?= $transport['transport_type'] ?></option>

                    <?php
                    }
                    ?>
                </select>

            </div>

            <div class="container7">
                <label class="form-label" for="typeNumber">Kilomètres</label>
                <input step="0.01" value="" type="number" id="typeNumber" class="form-control" name="kilometers" />
            </div>

            <div class="container7">
                <label for="ride_time">Temps de trajet</label>
                <input type="time" id="appt" name="ride_time" min="09:00" max="18:00" required />
            </div>


            <div class="container7">
                <button class="button" type="submit">Valider</button>
            </div>
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