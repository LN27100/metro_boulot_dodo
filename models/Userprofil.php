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
            $query->bindValue(':firstname', htmlspecialchars($prenom), PDO::PARAM_STR);
            $query->bindValue(':pseudo', htmlspecialchars($pseudo), PDO::PARAM_STR);
            $query->bindValue(':birthdate', $date_naissance, PDO::PARAM_STR);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->bindValue(':mdp', password_hash($mot_de_passe, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $query->bindValue(':id_entreprise', $enterprise_id, PDO::PARAM_INT);
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
            $sql = "SELECT userprofil.*, enterprise.enterprise_name
                FROM `userprofil` 
                INNER JOIN `enterprise` ON userprofil.enterprise_id = enterprise.enterprise_id
                WHERE `user_email` = :mail";

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
            $sql = "SELECT `enterprise_name` FROM `enterprise` WHERE `enterprise_id` = :id_entreprise";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':id_entreprise', $entreprise_id, PDO::PARAM_STR);

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

    /**
     * Méthode permettant de télécharger une image de profil
     * @param string $new_image_path est le nouveau nom de l'image télécharger
     * @param int $user_id est l'id de l'utilisateur
     */

     public static function updateProfileImage(int $user_id, string $new_image_path)
{
    try {
        $db = new PDO(DBNAME, DBUSER, DBPASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtenir le nom de fichier à partir du chemin de l'image
        $file_name = basename($new_image_path);

        $sql = "UPDATE userprofil SET user_photo = :new_image_name WHERE user_id = :user_id";

        $query = $db->prepare($sql);

        $query->bindValue(':new_image_name', $file_name, PDO::PARAM_STR);
        $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);

        $query->execute();
    } catch (PDOException $e) {
        echo 'Erreur :' . $e->getMessage();
        die();
    }
}


    /**
     * * Méthode pour modifier le profil utilisateur
     */
    public static function updateProfil(int $user_id, string $new_description, string $new_name, string $new_firstname, string $new_pseudo, string $new_email, string $new_dateofbirth, string $new_enterprise)
{   
    try {
        $db = new PDO(DBNAME, DBUSER, DBPASSWORD, array(PDO::ATTR_PERSISTENT => true));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE userprofil 
                SET user_describ = :new_description, 
                    user_name = :new_name, 
                    user_firstname = :new_firstname, 
                    user_pseudo = :new_pseudo, 
                    user_email = :new_email, 
                    user_dateofbirth = :new_dateofbirth, 
                    enterprise_id = :new_enterprise 
                WHERE user_id = :user_id";

        $query = $db->prepare($sql);

        $query->bindValue(':new_description', $new_description, PDO::PARAM_STR);
        $query->bindValue(':new_name', $new_name, PDO::PARAM_STR);
        $query->bindValue(':new_firstname', $new_firstname, PDO::PARAM_STR);
        $query->bindValue(':new_pseudo', $new_pseudo, PDO::PARAM_STR);
        $query->bindValue(':new_email', $new_email, PDO::PARAM_STR);
        $query->bindValue(':new_dateofbirth', $new_dateofbirth, PDO::PARAM_STR);
        $query->bindValue(':new_enterprise', $new_enterprise, PDO::PARAM_STR);
        $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);

        $query->execute();
    } catch (PDOException $e) {
        error_log('Erreur lors de la mise à jour du profil : ' . $e->getMessage());
        throw new Exception('Une erreur s\'est produite lors de la mise à jour du profil.');
    }
}

/**
 * Méthode pour supprimer le profil utilisateur
 * @param int $user_id est l'id de l'utilisateur
 * @return bool|string Renvoie true si la suppression est réussie, sinon renvoie un message d'erreur
 */

public static function deleteUser(int $user_id) {
    try {
        $db = new PDO(DBNAME, DBUSER, DBPASSWORD);

        $sql = "DELETE FROM userprofil WHERE user_id = :user_id";
        $query = $db->prepare($sql);
        $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $query->execute();

        
        return true;
    } catch (PDOException $e) {
        // Si une erreur se produit, retourner le message d'erreur
        return 'Erreur : ' . $e->getMessage();
    }
}
}
