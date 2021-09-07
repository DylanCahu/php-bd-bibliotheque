<?php
session_start();
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Biblio</title>

<style>

input[type=text] {
  width: 100%;
  padding: 5px 10px;
  margin: 8px 0;
}

</style>

</head>	

<body>
<a href='index.php' >Retour menu </a>

<?php

if (isset($_GET['type'])){
$type=$_GET['type'];
$_SESSION['type']= $type ;
$type = $_SESSION['type'] ;}

//début du fichier de gestion de bdd 



echo"<br><br><br>
<div class='menu1'>";


 echo"<h3>Insertion </h3>
 <form action='?.php' >
 <input type=hidden name=action value='Insertion' >

 Label :                 <input name=label       type=text placeholder='Entrez le label'    >	    <br>
 
 <input type='submit' value='envoyer a la base'>
 </form></div>";

 echo"<div class='menu2'>";

    echo "<h3>Recherche</h3>
    <form	action='?' >
    <input type=hidden name=action value='Recherche' >
    
 Label :                 <input name=label       type=text placeholder='Entrez le label'    >	    <br>
    
  <input type=submit value='Rechercher' >
  </form>";
  echo"</div>";

function  InsertBD    (){
 
  $Sexe = $_GET ["Sexe"] ;
  $nbrvaleurs=count($_GET);
  if ($Sexe == 'B'){echo'<h1>Le paramètre "sexe" n';echo"'"; echo 'est pas renseigné</h1>';}

  elseif ($nbrvaleurs != 7){echo'<h1>le formulaire est incomplet</h1>';}

  else{
  $NomFamille = $_GET ["NomFamille"] ;
  $Prenom = $_GET ["Prenom"] ;
  $Age = $_GET ["Age"] ;
  $Metier = $_GET ["Metier"] ;
  $departement = $_GET ["departement"] ;

 //--- Connection au SGBDR 
 $DataBase = mysqli_connect ( "mysql-dylan-cahu.alwaysdata.net" , "230465_biblio" , "biblioteque" ) ;

 //--- Ouverture de la base de données
 mysqli_select_db ( $DataBase, "dylan-cahu_bibliotheque" ) ;

 //--- Préparation de la requête
 $Requete = "INSERT INTO client (NomFamille, Prenom, Age, Sexe, Metier, NumDep) VALUES ( '$NomFamille', '$Prenom', $Age, '$Sexe', '$Metier', $departement);" ;
 //echo "<hr> $Requete <hr>" ;
 //--- Exécution de la requête (fin du script possible sur erreur ...)
 $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;

 echo "<h3> La personne $NomFamille $Prenom a été ajouté à la base <h3><hr>" ;
  
 //--- Libérer l'espace mémoire du résultat de la requête
 mysqli_free_result ( $Resultat ) ;

 //--- Déconnection de la base de données
 mysqli_close ( $DataBase ) ;
  }}

/*function  Recherche   (){

  $Nom = strtoupper($_GET ["Nom"]) ;
  $Prenom = strtoupper($_GET ["Prenom"]) ;

  //--- Début de table en HTML
  echo "<center>" ;
  echo "<table border>" ;
  echo "<caption> <h3> Clients </h3> </caption>" ;
  echo "<tr> <th> Nom </th> <th> Prénom </th> <th> Age </th> <th> Sexe </th> <th> Metier </th> <th> Departement </th> <th> Options </th> </tr>" ;

 //--- Connection au SGBDR 
 $DataBase = mysqli_connect ( "mysql-dylan-cahu.alwaysdata.net" , "230465_biblio" , "biblioteque" ) ;

 //--- Ouverture de la base de données
 mysqli_select_db ( $DataBase, "dylan-cahu_bibliotheque" ) ;

 //--- Préparation de la requête

 $Requete = "Select * From client join departement on client.NumDep=departement.NumDep where 1=1 " ;
 if ($Nom) $Requete= $Requete . "and UPPER (NomFamille) LIKE '%$Nom%'" ;
 if ($Prenom) $Requete= $Requete . "and UPPER (Prenom)  LIKE '%$Prenom%'" ;
 //echo"$Requete"; 
 //--- Exécution de la requête (fin du script possible sur erreur ...)
 $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;

 //--- Enumération des lignes du résultat de la requête
 while (  $ligne = mysqli_fetch_array($Resultat)  )
 {
  //--- Afficher une ligne du tableau HTML pour chaque enregistrement de la table 
  echo "<tr>\n" ;
  $id_option= $ligne['IDPers'] ;
  echo "<td>" . $ligne['NomFamille']    . "</td>\n" ;
  echo "<td>" . $ligne['Prenom']        . "</td>\n" ;
  echo "<td>" . $ligne['Age']           . "</td>\n" ;
  echo "<td>" . $ligne['Sexe']          . "</td>\n" ;
  echo "<td>" . $ligne['Metier']        . "</td>\n" ;
  echo "<td>" . $ligne['NomDep']        . "</td>\n" ;

  echo "<td> ";
  echo " 
  <form	action='?' >
  <input type=hidden name=id value='$id_option' >
  <input type=hidden name=action value='Suppression' >
  <input type=submit value='Supprimer' >
  </form>

  <form	action='?.php' >
  <input type=hidden name=action value='Modifier' > 
  <input type=hidden name=id value='$id_option' >
  <input type=submit value='Modifier' >
  </form>";
  echo "</td>";
  echo "</tr>\n" ;

 } 
 //--- Libérer l'espace mémoire du résultat de la requête
 mysqli_free_result ( $Resultat ) ;

 //--- Déconnection de la base de données
 mysqli_close ( $DataBase ) ;  

 //--- Fin de table en HTML
 echo "</table>" ;
 echo "</center>" ;

 echo " 
    <br>
    <h3>Modification recherche</h3>
    <br>
    <form	action='?' >
    <input type=hidden name=action value='Recherche' >
    Nom :                 <input name=Nom       type=text value='$Nom'    >	<br>
    Prénom :              <input name=Prenom    type=text value='$Prenom' >	<br><br>
      <input type=submit value='Rechercher' >
    </form>
    <hr>";}*/
function  ModifierBD  (){
  $id = $_GET ["id"] ;
  //--- Connection au SGBDR 
  $DataBase = mysqli_connect ( "mysql-dylan-cahu.alwaysdata.net" , "230465_biblio" , "biblioteque" ) ;

  //--- Ouverture de la base de données
  mysqli_select_db ( $DataBase, "dylan-cahu_bibliotheque" ) ;

  //--- Préparation de la requête
  $Requete = "Select * From client WHERE client.IDPERS = $id ;" ;
    
   //--- Exécution de la requête (fin du script possible sur erreur ...)
   $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;

   //--- Enumération des lignes du résultat de la requête
   if(  $ligne = mysqli_fetch_array($Resultat)  ){

    $NomFamille =   $ligne['NomFamille'];
    $Prenom =       $ligne['Prenom']    ;
    $Age =          $ligne['Age']       ;
    $Sexe =         $ligne['Sexe']      ;
    $Metier =       $ligne['Metier']    ;
    $NumDep =    $ligne['NumDep']    ;
  
    
 echo"<center><div class='menu3'>";
  
    echo "

  <h3>Modification</h3>
    <br>
  <form action='?.php' >
  <input type=hidden name=id   value=' $id '>
  <input type=hidden name=action value='Modifier2' >
  Nom :                 <input name=NomFamille       type=text value='$NomFamille'    >	    <br>
  Prénom :              <input name=Prenom    type=text value='$Prenom' >	    <br>
  Age :                 <input name=Age       type=text value='$Age' >	<br>";
  if ($Sexe=='H'){
  echo"
  Sexe :                <select name='Sexe' >
                                 <option value='H' selected>  homme </option>
                                 <option value='F'>  femme </option>
                                 <option value='A'>  autre </option>
                       </select><br>";}
  elseif ($Sexe=='F'){
  echo"
  Sexe :                <select name='Sexe' >
                                  <option value='H'>  homme </option>
                                  <option value='F' selected>  femme </option>
                                  <option value='A'>  autre </option>
                        </select><br>";}
  elseif ($Sexe=='A'){
  echo"
  Sexe :                <select name='Sexe' >
                                  <option value='H'>  homme </option>
                                  <option value='F'>  femme </option>
                                  <option value='A' selected >  autre </option>
                        </select><br>";
  }
  echo"
  Metier :              <input name=Metier       type=text value='$Metier'  >	<br>
  Departement :"; Generer_liste_dep($NumDep)  ;

 echo " <br><br>
    <form	action='?' >
    <input type=hidden name=action value='Modifier2' >
    <input type=submit value='Envoyer à la BD' >
    </form> 
    
    </div></center>";
  //--- Libérer l'espace mémoire du résultat de la requête
  mysqli_free_result ( $Resultat ) ;

  //--- Déconnection de la base de données
  mysqli_close ( $DataBase ) ;  }

  else echo"<h1>Modification impossible !</h1><hr>"; }
  
function  Modifier2BD (){
  $id=$_GET["id"];
  $NomFamille = $_GET ["NomFamille"] ;
  $Prenom = $_GET ["Prenom"] ;
  $Age = $_GET ["Age"] ;
  $Sexe = $_GET ["Sexe"] ;
  $Metier = $_GET ["Metier"] ;
  $departement = $_GET ["departement"] ;

 //--- Connection au SGBDR 
 $DataBase = mysqli_connect ( "mysql-dylan-cahu.alwaysdata.net" , "230465_biblio" , "biblioteque" ) ;

 //--- Ouverture de la base de données
 mysqli_select_db ( $DataBase, "dylan-cahu_bibliotheque" ) ;

 //--- Préparation de la requête
 $Requete = "UPDATE client
             SET NomFamille= '$NomFamille',
                 Prenom=     '$Prenom'    ,
                 Age=        '$Age'       ,
                 Sexe=       '$Sexe'      ,
                 Metier=     '$Metier'    ,
                 NumDep=     '$departement'
             WHERE  client.IDPERS = $id ;" ;
   
 //--- Exécution de la requête (fin du script possible sur erreur ...)
 $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;


  
 //--- Libérer l'espace mémoire du résultat de la requête
 //mysqli_free_result ( $Resultat ) ;

 //--- Déconnection de la base de données
 mysqli_close ( $DataBase ) ;}

function  SupprimerBD (){
  
  $id = $_GET['id'] ;
  

    if (  isset($id)  &&  ($id!='')  )
    {
      echo "<center> <b> Suppression du livre '" . $id ;
      echo "' de la base </center></b><br><br>" ;

      //--- Connection au SGBDR 
      $DataBase = mysqli_connect ( "mysql-dylan-cahu.alwaysdata.net" , "230465_biblio" , "biblioteque" ) ;

      //--- Ouverture de la base de données
      mysqli_select_db ( $DataBase, "dylan-cahu_bibliotheque" ) ;

      //--- Préparation de la requête
      $Requete = "Delete From ". $_SESSION['type'] ." Where id=$id" ;

      echo "$Requete <br>";

      //--- Exécution de la requête (fin du script possible sur erreur ...)
      $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;

      //--- Libérer l'espace mémoire du résultat de la requête
      //  mysql_free_result ( $Resultat ) ;

      //--- Déconnection de la base de données
      mysqli_close ( $DataBase ) ;  
    }
  }

function  ConsulterBD (){
    
  $type = $_SESSION['type'] ;
  
  echo "<center>" ;
  echo "<table border>" ;
  echo "<caption> <h3> $type </h3> </caption>" ;
  echo "<tr>  <th> Label </th> </tr>";

 //--- Connection au SGBDR 
 $DataBase = mysqli_connect ( "mysql-dylan-cahu.alwaysdata.net" , "230465_biblio" , "biblioteque" ) ;

 //--- Ouverture de la base de données
 mysqli_select_db ( $DataBase, "dylan-cahu_bibliotheque" ) ;

 //--- Préparation de la requête
 $Requete = "Select * from  $type  " ;
 
 echo "$Requete <br>";

 //--- Exécution de la requête (fin du script possible sur erreur ...)
 $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;

 while (  $ligne = mysqli_fetch_array($Resultat)  )
 {
  //--- Afficher une ligne du tableau HTML pour chaque enregistrement de la table 
  echo "<tr>\n" ;
  $id_option= $ligne['id'] ;
  echo "<td>" . $ligne['label']        . "</td>" ;

    echo "<td> ";
    echo " 
    <form	action='?' >
    <input type=hidden name=id value='$id_option' >
    <input type=hidden name=action value='Suppression' >
    <input type=submit value='Supprimer' >
    </form>
  
    <form	action='?.php' >
    <input type=hidden name=action value='Modifier' > 
    <input type=hidden name=id value='$id_option' >
    <input type=submit value='Modifier' >
    </form>";
    echo "</td>";
    echo "</tr>\n" ;
  }
  //--- Libérer l'espace mémoire du résultat de la requête
  mysqli_free_result ( $Resultat ) ;

  //--- Déconnection de la base de données
  mysqli_close ( $DataBase ) ;  

  //--- Fin de table en HTML
  echo "</table>" ;
  echo "</center>" ;}

//------------------------------------------------------------------------------
//  Programme Principal
{//-----------------------------------------------------------------------------

  $action='Affichage';

  if (count($_GET))
   {
   $action = $_GET['action'];
 
 

   if        ($action== 'Insertion'    ){InsertBD() ;}
   elseif    ($action== 'Suppression'  ){SupprimerBD() ;}
   elseif    ($action== 'Modifier'     ){ModifierBD() ;}
   elseif    ($action== 'Modifier2'    ){Modifier2BD() ;}
   elseif    ($action== 'Recherche'    ){Recherche() ;}
   elseif    ($action== 'Consulter'    ){ConsulterBD() ;}
   }

}//-----------------------------------------------------------------------------


?>