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
    <h1 class="titreAccueil">Eco'Mouv !!</h1>

    <div class="container3">
        <script>
            date = new Date().toLocaleDateString();
            document.write(date);
        </script>
    </div>

    <div class="container3">

        <?php
        require_once '../path/to/userprofil.php';

        // Appel de la méthode pour obtenir le pseudo de l'utilisateur à partir de la session
        $pseudo = Userprofil::getPseudoFromSession();

        // On vérifie si l'utilisateur est connecté
        if ($pseudo !== null) {
            // Si oui, on affiche le message de bienvenue avec le pseudo
            echo "<h3>Bienvenue \"$pseudo\"</h3>";
        } else {
            // Si non, on redirige vers la page de connexion
            header("Location: ../controllers/controller-signin.php");
            exit();
        }
        ?>
        <img src="../assets/img/avatarDefault.jpg" alt="avatar par défaut">
    </div>

    <div class="container3">
        <button class="buttonHome">Commencer un trajet</button>

        <button class="buttonHome">Historique des tajets</button>
    </div>

    <script>

    </script>
</body>

</html>

<!-- LEXIQUE -->

<!-- exit(); est une mesure de sécurité pour s'assurer qu'aucun code supplémentaire n'est exécuté après une redirection, ce qui pourrait potentiellement causer des problèmes ou générer un contenu non désiré dans la réponse HTTP. -->