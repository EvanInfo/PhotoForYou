<?php include ("../include/entete.inc.php"); ?>
<body>
    <div class="container text-center custom-margin-top-6">
        <h2>Téléversement de photo</h2>
        
        <form id="upload-form" action="../script/upload_photo.php" method="post" enctype="multipart/form-data">
            <label for="photo">Sélectionner une photo :</label>
            <input type="file" name="photo" id="photo" accept="image/*">
            <br>
            <label for="description">Description de la photo :</label>
            <textarea name="description" id="description"></textarea>
            <br>
            <input type="submit" value="Téléverser la photo">
            <br>
            <label for="categorie">Catégorie :</label>
            <select name="categorie" id="categorie">
            <?php
                $listeCategorie = $categorieManager->getCategorie(2);

                // Générer le menu HTML
                echo '<ul>';
                foreach ($listeCategorie as $categorie) {
                    echo '<option value="' . $categorie['idCategorie'] . '">' . $categorie['libelle'] . '</option>';
                }
                echo '</ul>';
                ?>


            </select>
            <br>
            <?php
                    /*
                    // Afficher le tableau
                    echo '<pre>';
                    var_dump($listeCategorie);
                    echo '</pre>';
                    */
            ?> 
           
        </form>
        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<p class="success-message">' . $_SESSION['success_message'] . '</p>';

            // Effacer le message de succès après l'avoir affiché
            unset($_SESSION['success_message']);
        }
        ?>
    </div>
</body>
<?php include ("../include/piedDePage.inc.php");?>