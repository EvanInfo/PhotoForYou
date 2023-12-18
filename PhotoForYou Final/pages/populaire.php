<?php
include ("../include/entete.inc.php");?>



<div class="container text-center custom-margin-top-6">
    <?php
    $photo = $photoManager->affichePhotos('Les plus populaire');
    
    //var_dump($photo);


    echo '<div class="list-unstyled">';
    foreach ($photo as $photos) {
        echo '<div class="photo">';
        echo '<img src="' . $photos['urlPhoto'] . '" alt="Photo">';
        echo '</div>';
    }
    echo '</div>';
    ?>
</div>












<?php
include("../include/piedDePage.inc.php");
?>