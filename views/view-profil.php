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

    <?php
        // empêche l'accès à la page home si l'utilisateur n'est pas connecté et vérifie si la session n'est pas déjà active
        if (session_status() === PHP_SESSION_NONE) {
            // Si non, démarrer la session
            session_start();
        }

        // Vérifie si la session existe avant d'accéder à ses valeurs
        if (isset($_SESSION['entreprise_id'], $_SESSION['pseudo'], $_SESSION['nom'], $_SESSION['prenom'], $_SESSION['email'], $_SESSION['date_naissance'])) {
            $entreprise_id = htmlspecialchars($_SESSION['entreprise_id']);
            $pseudo = htmlspecialchars($_SESSION['pseudo']);
            $nom = htmlspecialchars($_SESSION['nom']);
            $prenom = htmlspecialchars($_SESSION['prenom']);
            $email = htmlspecialchars($_SESSION['email']);
            $date_naissance = htmlspecialchars($_SESSION['date_naissance']);

            // Récupération du nom de l'entreprise depuis la base de données
            $entreprise_nom = Userprofil::getEntrepriseNom($entreprise_id);

            echo "<p>Nom de l'Entreprise: $entreprise_nom</p>";
            echo "<p>Pseudo: $pseudo</p>";
            echo "<p>Nom: $nom</p>";
            echo "<p>Prénom: $prenom</p>";
            echo "<p>Adresse Mail: $email</p>";
            echo "<p>Date de naissance: $date_naissance</p>";
        } else {
            echo "<p>Données non définies</p>";
        }
    ?>

    <a href="../controllers/controller-home.php" class="returnHome">Accueil</a>
    </div>
    <script>
  
</script>
</body>

</html>
