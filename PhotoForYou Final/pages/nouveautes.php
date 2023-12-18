<?php
include ("../include/entete.inc.php");
?>

<div class="row custom-margin-top-6">
    <?php
    $photo = $photoManager->affichePhotos('Les nouveautes');
    
    foreach ($photo as $photos) {
        echo '<div class="col-md-2 mb-3">';
        echo '<div class="card bg-warning border-dark text-center ">';
        echo '<img class="card-img-top custom-img-size d-block w-100" src="' . $photos['urlPhoto'] . '" alt="Photo">';
        
        // Ajouter le nom et la description ici
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $photos['nomPhoto'] . '</h5>';
        echo '<p class="card-text">' . $photos['description'] . '</p>';
        echo '</div>';
        
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>


<?php
include("../include/piedDePage.inc.php");
?>
