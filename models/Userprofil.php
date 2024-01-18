<?php

class Userprofil
{
    /**
     * Méthode permettant de créer un utilisateur
     * @param string $nom Nom de l'utilisateur
     * @param string $prenom Prénom de l'utilisateur
     * @param string $pseudo Pseudo de l'utilisateur
     * @param string $date_naissance Date de naissance de l'utilisateur
     * @param string $email Email de l'utilisateur
     * @param string $mot_de_passe Mot de passe de l'utilisateur
     * @param string $enterprise_id Id de l'entreprise de l'utilisateur
     * @param int $user_validate Validation de l'utilisateur
     */

     public static function create(string $nom, string $prenom, string $pseudo, string $date_naissance, string $email, string $mot_de_passe, string $enterprise_id, int $user_validate)
     {
        try {
            // Conexion à la base de données
            $db = new PDO(DBNAME, DBUSER, DBPASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Stockage de la requete dans une variable
            $sql = "INSERT INTO userprofil (user_name, user_firstname, user_pseudo, user_dateofbirth, user_email, user_password, enterprise_id, user_validate)
             VALUES (:lastname, :firstname, :pseudo, :birthdate, :email, :mdp, :id_entreprise, :valide_participant)";

            // Préparation de la requête
            $query = $db->prepare($sql);

            // Relier les valeurs aux marqueurs nominatifs
            $query->bindValue(':lastname', htmlspecialchars($nom), PDO::PARAM_STR);
        $_SESSION['nom'] = htmlspecialchars($nom);

        $query->bindValue(':firstname', htmlspecialchars($prenom), PDO::PARAM_STR);
        $_SESSION['prenom'] = htmlspecialchars($prenom);

        $query->bindValue(':pseudo', htmlspecialchars($pseudo), PDO::PARAM_STR);
        $_SESSION['pseudo'] = htmlspecialchars($pseudo);

        $query->bindValue(':birthdate', $date_naissance, PDO::PARAM_STR);
        $_SESSION['date_naissance'] = $date_naissance;

        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $_SESSION['email'] = $email;

            $query->bindValue(':mdp', password_hash($mot_de_passe, PASSWORD_DEFAULT), PDO::PARAM_STR);

            $query->bindValue(':id_entreprise', $enterprise_id, PDO::PARAM_STR);
            $_SESSION['enterprise_id'] = $enterprise_id;

            $query->bindValue(':valide_participant', $user_validate, PDO::PARAM_INT);

            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur :' . $e->getMessage();
            die();
        }
    }

    /**
     * Methode permettant de récupérer les informations d'un utilisateur avec son mail comme paramètre
     * 
     * @param string $email Adresse mail de l'utilisateur
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
            $sql = "SELECT * FROM `userprofil` WHERE `user_email` = :mail";

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
     * Methode permettant de vérifier si le pseudo existe déjà dans la base de données
     * 
     * @param string $pseudo Pseudo à vérifier
     * 
     * @return bool
     */
    public static function checkPseudoExists(string $pseudo): bool
    {
        try {
            $db = new PDO(DBNAME, DBUSER, DBPASSWORD);

            $sql = "SELECT * FROM `userprofil` WHERE `user_pseudo` = :pseudo";

            $query = $db->prepare($sql);
            $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);

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
     * Methode permettant de récupérer les infos d'un utilisateur avec son mail comme paramètre
     * 
     * @param string $email Adresse mail de l'utilisateur
     * 
     * @return array Tableau associatif contenant les infos de l'utilisateur
     */
    public static function getInfos(string $email): array
    {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO(DBNAME, DBUSER, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * FROM `userprofil` WHERE `user_email` = :mail";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':mail', $email, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // on retourne le résultat
            return $result;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    /**
     * Methode permettant de récupérer le nom de l'entreprise à partir de son ID
     * 
     * @param string $entreprise_id ID de l'entreprise
     * 
     * @return string Nom de l'entreprise
     */
    public static function getEntrepriseNom(string $entreprise_id): string
    {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO(DBNAME, DBUSER, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT `enterprise_name` FROM `enterprise` WHERE `enterprise_id` = :entreprise_id";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':entreprise_id', $entreprise_id, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // on retourne le nom de l'entreprise
            return $result['enterprise_name'];
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }
}
