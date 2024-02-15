<?php 

class Enterprise
{
     /**
     * Méthode permettant de récupérer toutes les entreprises sous forme de JSON
     * 
     * @return string JSON contenant les données des entreprises
     */
    public static function newGetAllEntreprise(): string
    {
        try {
            // Connexion à la base de données
            $db = new PDO(DBNAME, DBUSER, DBPASSWORD);

            // Préparation de la requête SQL
            $sql = "SELECT * FROM enterprise";

            // Préparation de la requête
            $query = $db->prepare($sql);

            // Exécution de la requête
            $query->execute();

            // Récupération du résultat sous forme de tableau associatif
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            // Fermeture de la connexion à la base de données
            $db = null;

            // Convertion du résultat en JSON et  on le retourne
            return json_encode([
                'status' => 'success',
                'message' => 'Entreprises récupérées',
                'data' => $result
            ]);
        } catch (PDOException $e) {
            // message d'erreur
            return json_encode([
                'status' => 'error',
                'message' => 'Erreur : ' . $e->getMessage()
            ]);
        }
    }
}
