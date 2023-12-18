<?php
class CategorieManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDB($db);
    }
    
    /**
     * Récupère et affiche les photos de la base de données en fonction de la catégorie spécifiée.
     *
     * @param string $categorie La catégorie utilisée comme critère de recherche pour les photos.
     * @return array Un tableau de tableaux associatifs représentant les informations des photos récupérées.
     *              Chaque tableau associatif correspond à une photo.
     * @throws Exception En cas d'erreur lors de la récupération des photos depuis la base de données.
     */
    public function getCategorie($id)
    {
        $q = $this->_db->prepare('SELECT idCategorie, libelle FROM categorie WHERE idCategorie > :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();

        $categorieInfo = $q->fetchAll(PDO::FETCH_ASSOC);

        // Fermeture du curseur
        $q->closeCursor();

        return $categorieInfo;
    }
        
    /**
     * Récupère les informations d'une catégorie avec un identifiant spécifié.
     *
     * @param int $id L'identifiant de la catégorie à récupérer.
     * @return array|false Un tableau associatif représentant les informations de la catégorie récupérée,
     *                     ou false si la catégorie n'est pas trouvée.
     */
    public function getCategorieById($id)
    {
        $q = $this->_db->prepare('SELECT idCategorie, libelle FROM categorie WHERE idCategorie = :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();

        $categorieInfo = $q->fetch(PDO::FETCH_ASSOC);

        // Fermeture du curseur
        $q->closeCursor();

        return $categorieInfo;
    }

    public function setDB(PDO $db)
    {
        $this->_db = $db;
    }
}
?>
