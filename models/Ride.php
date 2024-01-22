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
    
 public static function create(int $ride_id, string $date, string $distance, int $user_id, $transport_id)
    {
        try {
            // Conexion à la base de données
            $db = new PDO(DBNAME, DBUSER, DBPASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Stockage de la requete dans une variable
            $sql = "INSERT INTO ride (ride_id, ride_date, ride_distance, user_id, transport_id)
             VALUES (:id_ride, :dateride, :distanceride, :id_user, :id_transport)";

            // Préparation de la requête
            $query = $db->prepare($sql);

            // Relier les valeurs aux marqueurs nominatifs
            $query->bindValue(':id_ride', htmlspecialchars($ride_id), PDO::PARAM_INT);
            $query->bindValue(':dateride', htmlspecialchars($date), PDO::PARAM_STR);
            $query->bindValue(':distanceride', htmlspecialchars($distance), PDO::PARAM_STR);
            $query->bindValue(':id_user', $user_id, PDO::PARAM_INT);
            $query->bindValue(':id_transport', $transport_id, PDO::PARAM_INT);
        

            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur :' . $e->getMessage();
            die();
        }
    }
    
public static function getInfos(string $utilisateurInfos): array
    {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO(DBNAME, DBUSER, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT transport.*, transport.transport_id 
            FROM `ride` 
            INNER JOIN `transport` ON ride.transport_id = transport.transport_id";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':user', $utilisateurInfos, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // on retourne le résultat
            return $result ?? [];
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }
}

