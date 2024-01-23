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

    
}

