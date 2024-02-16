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

    <!-- Ajoute cette div pour le pop-up de confirmation -->
    <div id="trajetAddedConfirm" class="popup-confirm">
        <div class="popup-content">
            <p>Le trajet a bien été ajouté !</p>
        </div>
    </div>

    <div class="container8">
        <div class="row">

            <!-- Popup confirmation suppression -->
            <div id="popupConfirm" class="popup-confirm">
                <div class="popup-content">
                    <p id="deleteText"></p>
                    <form id="deleteForm" action="../controllers/controller-history.php" method="POST">
                        <input type="hidden" name="ride_id" id="ride_id" value="">
                        <div class="btn-container">
                            <button id="btn-accept" class="btnYes" type="submit">Oui</button>
                            <button id="btn-cancel" class="btnNo">Non</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <p class="sommeKms">Total kilomètres parcourus : <?= Ride::sommeKms($user_id)['total'] . ' kms'  ?></p>
            </div>

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
                                    <form action="" method="post">
                                        <input class="suppRide" type="hidden" name="ride_id" value="<?= $trajet['ride_id'] ?>">
                                        <button class="btnSupp" type="submit">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                                <td><?= $trajet['date_fr'] ?></td>
                                <td><?= $trajet['transport_type'] ?></td>
                                <td><?= $trajet['ride_distance'] . ' kms' ?></td>
                                <td><?= $trajet['heure_minute'] ?></td>
                            </tr>

                        <?php
                        }
                        ?>

                    </tbody>

                </table>
                <p class="emptyTable"><?= empty(Ride::getAllTrajets($user_id)) ? 'Aucun trajets à afficher ! ' : ''  ?></p>

            </section>
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
                const trajetAddedConfirm = document.getElementById("trajetAddedConfirm");
                trajetAddedConfirm.style.display = "block"; 
                setTimeout(function() {
                    trajetAddedConfirm.style.display = "none"; 
                }, 1500); // 1500 millisecondes (1 secondes et demi) avant de masquer le pop-up
            }
        });



        document.addEventListener("DOMContentLoaded", function() {
            let popupConfirm = document.getElementById("popupConfirm");
            let btnCancel = document.getElementById("btn-cancel");
            let btnDelete = document.querySelectorAll(".btnSupp");
            let rideIdInput = document.getElementById("ride_id");
            let deleteText = document.getElementById("deleteText");

            // Cache le pop-up de confirmation au chargement de la page
            popupConfirm.style.display = "none";

            btnDelete.forEach(function(button) {
                button.addEventListener("click", function(event) {
                    event.preventDefault();
                    let rideId = button.parentElement.querySelector('input[type="hidden"]').value;
                    let rideDistance = button.parentElement.parentElement.nextElementSibling.innerText;
                    let rideDate = button.parentElement.parentElement.nextElementSibling.nextElementSibling.innerText;

                    rideIdInput.value = rideId;
                    deleteText.innerHTML = "<b>Supprimer ce trajet ?</b> </br>" + rideDistance + "</br>" + rideDate;
                    popupConfirm.style.display = "block"; // Affiche le pop-up de confirmation
                });
            });

            btnCancel.addEventListener("click", function(event) {
                event.preventDefault(); // Empêche le formulaire de soumettre ses données
                popupConfirm.style.display = "none"; // Masque le pop-up de confirmation lorsque "Non" est cliqué
            });

            window.onclick = function(event) {
                if (event.target == popupConfirm) {
                    popupConfirm.style.display = "none"; // Masque le pop-up de confirmation lorsque l'utilisateur clique en dehors du pop-up
                }
            };
        });
    </script>


</body>

</html>