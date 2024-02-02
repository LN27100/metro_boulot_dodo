<?php

class Admin
{
    /**
     * Méthode permettant de créer un administrateur
     * @param string $email Email de l'administrateur
     * @param string $mot_de_passe Mot de passe de l'administrateur
     */

    public static function create(string $email, string $mot_de_passe)
    {
        try {
            // Conexion à la base de données
            $db = new PDO(DBNAME, DBUSER, DBPASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Stockage de la requete dans une variable
            $sql = "INSERT INTO `admin` (admin_email, admin_password)
             VALUES (:admin_email, :admin_password)";

            // Préparation de la requête
            $query = $db->prepare($sql);

            // Relier les valeurs aux marqueurs nominatifs
            $query->bindValue(':admin_email', $email, PDO::PARAM_STR);
            $query->bindValue(':admin_password', password_hash($mot_de_passe, PASSWORD_DEFAULT), PDO::PARAM_STR);
            

            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur :' . $e->getMessage();
            die();
        }
    }

    /**
     * Methode permettant de récupérer les informations d'un administrateur avec son mail comme paramètre
     * 
     * @param string $email Adresse mail de l'administrateur
     * 
     * @return bool
     */
    public static function checkMailExists(string $email): bool
    {
        // le try and catch permet de gérer les erreurs, nous allons l'utiliser pour gérer les erreurs liées à la base de données
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO(DBNAME, DBUSER, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * FROM `admin` WHERE `admin_email` = :mail";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':mail', $email, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // on vérifie si le résultat est vide car si c'est le cas, cela veut dire que le mail n'existe pas
            if (empty($result)) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    
    /**
     * Methode permettant de récupérer les infos d'un administrateur avec son mail comme paramètre
     * 
     * @param string $email Adresse mail de l'administrateur
     * 
     * @return array Tableau associatif contenant les infos de l'administrateur
     */
    public static function getInfos(string $email): array
    {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO(DBNAME, DBUSER, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT *
                FROM `admin` 
                WHERE `admin_email` = :mail";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':mail', $email, PDO::PARAM_STR);

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

    
   
    /**
     * * Méthode pour modifier le profil administrateur
     */
    public static function updateProfil(int $admin_id, string $new_email)
{   
    try {
        $db = new PDO(DBNAME, DBUSER, DBPASSWORD, array(PDO::ATTR_PERSISTENT => true));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE `admin` 
                SET admin_email = :new_email, 
                WHERE admin_id = :admin_id";

        $query = $db->prepare($sql);

        $query->bindValue(':new_email', $new_email, PDO::PARAM_STR);
        $query->bindValue(':admin_id', $admin_id, PDO::PARAM_INT);

        $query->execute();
    } catch (PDOException $e) {
        error_log('Erreur lors de la mise à jour du profil : ' . $e->getMessage());
        throw new Exception('Une erreur s\'est produite lors de la mise à jour du profil.');
    }
}

/**
 * Méthode pour supprimer le profil administrateur
 * @param int $admin_id est l'id de l'administrateur
 * @return bool|string Renvoie true si la suppression est réussie, sinon renvoie un message d'erreur
 */

public static function deleteAdmin(int $admin_id) {
    try {
        $db = new PDO(DBNAME, DBUSER, DBPASSWORD);

        $sql = "DELETE FROM `admin` WHERE admin_id = :admin_id";
        $query = $db->prepare($sql);
        $query->bindValue(':admin_id', $admin_id, PDO::PARAM_INT);
        $query->execute();

        
        return true;
    } catch (PDOException $e) {
        // Si une erreur se produit, retourner le message d'erreur
        return 'Erreur : ' . $e->getMessage();
    }
}
}
