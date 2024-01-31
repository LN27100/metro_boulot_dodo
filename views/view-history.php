<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <title>Historique trajets</title>
</head>

<body>



    <h1 class="titreAccueil">Eco'Mouv !!</h1>


    <div class="container4">

        <?php echo "<h2 class='tittleHistory'>Historique trajets $pseudo</h2>"; ?>

    </div>

    <div class="container8">
        <div class="row">


            <section class="col-12">
                <table class="table">
                    <thead>
                        <th>Supp</th>
                        <th>Date</th>
                        <th>Transport</th>
                        <th>Distance</th>
                        <th>Durée</th>
                    </thead>

                    <tbody>
                        <!-- je parcours le tableau de tous les trajets et je stocke chaque fois que je tombe sur une ligne -->
                        <?php foreach (Ride::getAllTrajets($user_id) as $trajet) {
                        ?>

                            <tr>
                                <td>
                                    <form action="../controllers/controller-history.php" method="post">
                                        <input class="suppRide" type="hidden" name="ride_id" value="<?= $trajet['ride_id'] ?>">
                                        <button class="btnSupp" type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ce trajet ?')">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                                <td><?= $trajet['date_fr'] ?></td>
                                <td><?= $trajet['transport_type'] ?></td>
                                <td><?= $trajet['ride_distance'] . ' kms' ?></td>
                                <td><?= $trajet['ride_time'] ?></td>
                            </tr>

                        <?php
                        }
                        ?>


                    </tbody>
                </table>
            </section>
        </div>

        <div class="text-center">
            <p class="totalKms">Total kilomètres parcourus :</p>
            <p class="sommeKms"><?= Ride::sommeKms($user_id)['total'] . ' kms'  ?></p>
        </div>


        <div class="text-center">
            <a href="../controllers/controller-ride.php" class="newTrajet">Nouveau trajet</a>
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
            const params = new URLSearchParams(window.location.search);
            const trajetAdded = params.get('trajetAdded');

            if (trajetAdded) {
                alert("Le trajet a bien été ajouté !");
            }
        });
    </script>


</body>

</html>