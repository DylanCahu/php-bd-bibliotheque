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

 $sql = "select * from $info" ;

 //on prépare la requête
$stmt = mysqli_prepare($DataBase, $sql);
 
//on relie la variable id
mysqli_stmt_bind_param($stmt, "i", $id);

//on définit les variables qui vont être recup
mysqli_stmt_execute($stmt, $id, $label);
 
//on récupère le résultat
mysqli_stmt_fetch($stmt);

echo 'Il y a' . mysqli_num_rows($stmt) .  'entrée(s) dans la base de données <br>';

 while (  $donnees = mysqli_fetch_array($stmt)  )
 {
	 echo $donnees['id'] . ' ' .$donnees['libelle'] . '</br>' ;
 }
 
 ?>
 
 </body>
 </html>