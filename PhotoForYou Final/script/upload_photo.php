<?php
require_once '../include/entete.inc.php'; 

// Permet le transfert des photos vers la base de donnée a partir du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    $categorieId = $_POST['categorie'];

    // Préparer une requête pour récupérer le libellé de la catégorie depuis la base de données (utilisation de procédure stockée)
    $requete = $db->prepare("CALL GetLibelleCategorie()");

    $requete->execute();

    // Récupérer les résultats de la requête
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);

    
    $requete->closeCursor();

    
    $categorieInfo = $categorieManager->getCategorieById($categorieId);

    // Préparer les données de la photo pour l'ajout à la base de données
    $photoData = [
        'nomPhoto' => $_FILES['photo']['name'],
        'taillePixelX' => getimagesize($_FILES['photo']['tmp_name'])[0],
        'taillePixelY' => getimagesize($_FILES['photo']['tmp_name'])[1],
        'poids' => $_FILES['photo']['size'],
        'idUser' => $_SESSION['idUser'], 
        'urlPhoto' => '../images/vendre_stock/' . $_FILES['photo']['name'], 
        'categorie' => $categorieInfo['libelle'] . ',' . $resultat['libelle'], 
        'description'=> $_POST['description']
    ];

    
    $photoManager->addPhoto($photoData);
    
    // Téléverser le fichier sur le serveur
    move_uploaded_file($_FILES['photo']['tmp_name'], '../images/vendre_stock/' . $_FILES['photo']['name']);

    // Définir un message de succès et rediriger vers la page de vente
    $_SESSION['success_message'] = "L'image a été transférée avec succès!";
    header("Location: ../pages/vendre.php");
} else {
    // Redirection ou message d'erreur si le formulaire n'a pas été soumis
    header("Location: ../pages/vendre.php");
    exit();
}
?>
