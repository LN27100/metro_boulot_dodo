<?php 

class Ride
{
    /**
     * Méthode permettant de créer un utilisateur
     * @param int $ride_id Id du trajet
     * @param string $date Date du trajet
     * @param string $ditance Kilomètres parcourus
     * @param string $user_id Id de l'utilisateur
     * @param int $transport_id Id du moyen de transport
     */

 public static function create(string $date, int $transport_id, string $distance,string $ride_time, int $user_id )
    {
        try {
            // Conexion à la base de données
            $db = new PDO(DBNAME, DBUSER, DBPASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Stockage de la requete dans une variable
            $sql = "INSERT INTO ride ( ride_date, transport_id, ride_distance, ride_time, user_id)
             VALUES (:dateride,:id_transport, :distanceride, :ride_time, :id_user)";

            // Préparation de la requête
            $query = $db->prepare($sql);

            // Relier les valeurs aux marqueurs nominatifs
            $query->bindValue(':dateride', htmlspecialchars($date), PDO::PARAM_STR);
            $query->bindValue(':distanceride', htmlspecialchars($distance), PDO::PARAM_STR);
            $query->bindValue(':id_user', $user_id, PDO::PARAM_INT);
            $query->bindValue(':id_transport', $transport_id, PDO::PARAM_INT);
            $query->bindValue(':ride_time', $ride_time, PDO::PARAM_STR);

        

            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur :' . $e->getMessage();
            die();
        }
    }

    public static function getAllTrajets(int $user_id) {
        try {
            $db = new PDO(DBNAME, DBUSER, DBPASSWORD);
    
            $sql = "SELECT * , DATE_FORMAT(ride_date, '%d/%m/%Y') AS date_fr FROM `ride`NATURAL JOIN `transport` WHERE `user_id`= :id_user ORDER BY `ride_date` DESC";
            $query = $db->prepare($sql);
            $query->bindValue(':id_user', $user_id, PDO::PARAM_INT);
            $query->execute();
    
            // Utiliser fetchAll pour récupérer tous les résultats
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;  // Retourner le tableau des trajets
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }
}

    // Modification de trajet (Update)

    // public static function updateRide($ride_id, $date, $distance, $ride_time, $transport_id, $user_id)
    // {
    //     try {
    //         $db = new PDO(DBNAME, DBUSER, DBPASSWORD);
    //         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //         $sql = "UPDATE ride 
    //                 SET ride_date = :dateride,
    //                     transport_id = :id_transport,
    //                     ride_distance = :distanceride,
    //                     ride_time = :ride_time,
    //                     user_id = :id_user
    //                 WHERE ride_id = :id_ride";
    
    //         $query = $db->prepare($sql);
    
    //         $query->bindValue(':dateride', htmlspecialchars($date), PDO::PARAM_STR);
    //         $query->bindValue(':distanceride', htmlspecialchars($distance), PDO::PARAM_STR);
    //         $query->bindValue(':id_user', $user_id, PDO::PARAM_INT);
    //         $query->bindValue(':id_transport', $transport_id, PDO::PARAM_INT);
    //         $query->bindValue(':ride_time', $ride_time, PDO::PARAM_STR);
    //         $query->bindValue(':id_ride', $ride_id, PDO::PARAM_INT);
    
    //         $query->execute();
    //     } catch (PDOException $e) {
    //         echo 'Erreur :' . $e->getMessage();
    //         die();
    //     }
    // }
    
    // // Utilisation de la fonction
    // Ride::updateJeu($bdd, $nvprix, $nv_nb_joueurs, $nom_jeu);

