<?php

class Userprofil {
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

    public static function create(string $nom, string $prenom, string $pseudo, string $date_naissance, string $email, string $mot_de_passe, string $enterprise_id, int $user_validate){
        try {

            // Conexion à la base de données
            $db = new PDO(DBNAME, DBUSER, DBPASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Stockage de la requete dans variable
            $sql = "INSERT INTO userprofil (user_name, user_firstname, user_pseudo, user_dateofbirth, user_email, user_password, enterprise_id, user_validate)
            VALUES (:lastname, :firstname, :pseudo, :birthdate, :email, :mdp, :id_entreprise, :valide_participant)";

            // Préparation de la requète
            $query = $db->prepare($sql);

            // Relier les valeurs aux marqueurs nominatifs
            $query->bindValue(':lastname', htmlspecialchars($nom), PDO::PARAM_STR);
            $query->bindValue(':firstname', htmlspecialchars($prenom), PDO::PARAM_STR);
            $query->bindValue(':pseudo', htmlspecialchars($pseudo), PDO::PARAM_STR);
            $query->bindValue(':birthdate', $date_naissance, PDO::PARAM_STR);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->bindValue(':mdp', password_hash($mot_de_passe, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $query->bindValue(':id_entreprise', $enterprise_id, PDO::PARAM_STR);
            $query->bindValue(':valide_participant', $user_validate, PDO::PARAM_INT);

            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur :' . $e->getMessage();
            die();
        }
    }}