<html>
<head>
<meta charset="ISO-8859-1">
<title> Biblio </title>
<?php

	$info=$_GET['info'];

  //--- Connection au SGBDR 
 $DataBase = mysqli_connect ( "mysql-dylan-cahu.alwaysdata.net" , "230465_biblio" , "biblioteque" ) ;

 //--- Ouverture de la base de données
 mysqli_select_db ( $DataBase, "dylan-cahu_bibliotheque" ) ;

 //--- Préparation de la requête
 $Requete = "select * from $info" ;
 
 //--- Exécution de la requête (fin du script possible sur erreur ...)
 $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;

echo 'Il y a' . mysqli_num_rows($Resultat) .  'entrée(s) dans la base de données <br>';

 while (  $donnees = mysqli_fetch_array($Resultat)  )
 {
	 echo $donnees['id'] . ' ' .$donnees['libelle'] . '</br>' ;
 }
 
 ?>
 
 </body>
 </html>