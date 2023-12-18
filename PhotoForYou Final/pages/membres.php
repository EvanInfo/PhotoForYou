<?php
	include ("../include/entete.inc.php");
	echo generationEntete("Page des utilisateurs", "Bonjour ".$_SESSION['NomUtilisateur']);
	echo ("Bonjour ".$_SESSION['TypeUtilisateur']);
	//echo ("Bonjour ".$_SESSION['idUser']);
	/*$sonType = 'visiteur'; // Remplacez par la valeur appropriée
	$menuItems = $manager->getMenu($sonType);

	// Utilisez $menuItems comme nécessaire*/

	include ("../include/piedDePage.inc.php");
?>

