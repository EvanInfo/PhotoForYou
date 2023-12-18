<?php
/**
 * Classe PhotoManager
 *
 * Gère l'interaction avec la table 'photos' dans la base de données.
 */
class PhotoManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDB($db);
	}
	
	 /**
     * Ajoute une nouvelle photo à la base de données.
     *
     * @param Photo $photo L'objet Photo à ajouter.
     * @return void
     */
	public function add(Photo $photo)
    {
        $q = $this->_db->prepare('INSERT INTO photos (nomPhoto, taillePixelX, taillePixelY, poids, idUser, urlPhoto, categorie, description, estSupprimee) VALUES (:nomPhoto, :taillePixelX, :taillePixelY, :poids, :idUser, :urlPhoto, :categorie, :description, 0)');

    
        $q->bindValue(':nomPhoto', $photo->getNomPhoto());
        $q->bindValue(':taillePixelX', $photo->getTaillePixelX());
        $q->bindValue(':taillePixelY', $photo->getTaillePixelY());
        $q->bindValue(':poids', $photo->getPoids());
        $q->bindValue(':idUser', $photo->getIdUser());
        $q->bindValue(':urlPhoto', $photo->getUrlPhoto());
        $q->bindValue(':categorie', $photo->getCategorie());
        $q->bindValue(':description', $photo->getDescription());
    
        $q->execute();
    
        $photo->setId($this->_db->lastInsertId());
    }
        
   /**
     * Récupère des photos de la base de données en fonction de la catégorie spécifiée.
     *
     * @param string $categorie La catégorie pour filtrer les photos.
     * @return array Un tableau de tableaux associatifs représentant les photos récupérées.
     * @throws Exception S'il y a une erreur lors du processus de récupération.
     */
    public function getPhotoSupprimee()
    {
        try {
            // Requête pour obtenir une photo supprimée
            $q = $this->_db->prepare('SELECT * FROM photos WHERE estSupprimee = 1 LIMIT 1');
            $q->execute();

            $result = $q->fetch(PDO::FETCH_ASSOC);

            // Fermeture du curseur
            $q->closeCursor();

            return $result;
        } catch (PDOException $e) {
            // Gérer les erreurs PDO ici
            throw new Exception("Erreur lors de la récupération d'une photo supprimée : " . $e->getMessage());
        }
    }
    
        
    /**
     * Récupère et affiche les photos de la base de données en fonction de la catégorie spécifiée.
     *
     * @param string $categorie La catégorie utilisée comme critère de recherche pour les photos.
     * @return array Un tableau de tableaux associatifs représentant les informations des photos récupérées.
     *              Chaque tableau associatif correspond à une photo.
     * @throws Exception En cas d'erreur lors de la récupération des photos depuis la base de données.
     */
    public function affichePhotos($categorie)
    {
        try {
            // Requête pour obtenir des photos en fonction de la catégorie
            $q = $this->_db->prepare('SELECT * FROM photos WHERE categorie LIKE :categorie');
            
            // Utilisation de bindValue au lieu de bindParam pour éviter la nécessité de passer par référence
            $q->bindValue(':categorie', '%' . $categorie . '%', PDO::PARAM_STR);
            
            $q->execute();

            // Récupération de toutes les lignes (fetchAll) au lieu d'une seule ligne (fetch)
            $result = $q->fetchAll(PDO::FETCH_ASSOC);

            // Fermeture du curseur
            $q->closeCursor();

            return $result;
        } catch (PDOException $e) {
            // Gérer les erreurs PDO ici
            throw new Exception("Erreur lors de la récupération des photos : " . $e->getMessage());
        }
    }




     /**
     * Met à jour les informations d'une photo existante dans la base de données.
     *
     * @param int $idPhoto L'ID de la photo à mettre à jour.
     * @param array $photoData Un tableau associatif contenant les données mises à jour de la photo.
     * @return void
     */
    public function updatePhoto($idPhoto, $photoData)
    {
        // Requête pour mettre à jour les informations d'une photo existante
        $q = $this->_db->prepare('UPDATE photos SET nomPhoto = :nomPhoto, taillePixelX = :taillePixelX, taillePixelY = :taillePixelY, poids = :poids, idUser = :idUser, urlPhoto = :urlPhoto, categorie = :categorie, description = :description, estSupprimee = 0 WHERE idPhoto = :idPhoto');

        $q->bindValue(':nomPhoto', $photoData['nomPhoto']);
        $q->bindValue(':taillePixelX', $photoData['taillePixelX']);
        $q->bindValue(':taillePixelY', $photoData['taillePixelY']);
        $q->bindValue(':poids', $photoData['poids']);
        $q->bindValue(':idUser', $photoData['idUser']);
        $q->bindValue(':urlPhoto', $photoData['urlPhoto']);
        $q->bindValue(':categorie', $photoData['categorie']);
        $q->bindValue(':description', $photoData['description']);
        $q->bindValue(':idPhoto', $idPhoto);

        $q->execute();
    }    
    /**
     * Ajoute une nouvelle photo ou met à jour une photo supprimée existante dans la base de données.
     *
     * @param array $photoData Un tableau associatif contenant les données de la photo.
     * @return Photo L'objet Photo ajouté ou mis à jour.
     */
    public function addPhoto(array $photoData)
    {
        $photoExistante = $this->getPhotoSupprimee();

        if ($photoExistante) {
            // Réutilisez l'ID de la photo supprimée
            $idPhoto = $photoExistante['idPhoto'];

            // Marquez la photo comme non supprimée et mettez à jour les autres informations
            $this->updatePhoto($idPhoto, $photoData);
        } else {
            $photo = new Photo($photoData);
            $this->add($photo);
            return $photo;
        }
    }


	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}
}
?>