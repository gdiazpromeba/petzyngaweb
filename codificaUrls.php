<?php

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/UrlUtils.php';



 $db_connection = new mysqli("localhost", $GLOBALS['usuario'] , $GLOBALS['clave'] , $GLOBALS['baseDeDatos']);
 $db_connection->set_charset("utf8");
 

 function seleccionaYActualiza($selSql, $updSql, $db_connection){
   if (!$stmSel = $db_connection->prepare($selSql)){
     echo $db_connection->error;
     exit();
   }
   if (!$stmUpd = $db_connection->prepare($updSql)){
     echo $db_connection->error;
     exit();
   }
   $stmSel->execute();
   $stmSel->store_result();
   $stmSel->bind_result($id, $nombre, $codificado);
   while ($stmSel->fetch()) {
     $codificado=UrlUtils::codifica($nombre); 	
     $stmUpd->bind_param("ss", $codificado, $id);
     $stmUpd->execute(); 
   }
   $stmSel->free_result();
   $stmSel->close();
   $stmUpd->close();
 }
 
 
 //dog breeds
 echo "dog breeds ...";
 $selSql="SELECT DOG_BREED_ID, DOG_BREED_NAME, NAME_ENCODED FROM DOG_BREEDS";
 $updSql="UPDATE DOG_BREEDS SET NAME_ENCODED=? WHERE DOG_BREED_ID=?";
 seleccionaYActualiza($selSql, $updSql, $db_connection);
 
 
 //breeders usa
 echo "breeders usa ...";
 $selSql="SELECT ID, NAME, URL_ENCODED FROM BREEDERS_USA";
 $updSql="UPDATE BREEDERS_USA SET URL_ENCODED=? WHERE ID=?";
 seleccionaYActualiza($selSql, $updSql, $db_connection);
 
 //breeders UK
 echo "breeders uk ...";
 $selSql="SELECT ID, NAME, URL_ENCODED FROM BREEDERS_UK";
 $updSql="UPDATE BREEDERS_UK SET URL_ENCODED=? WHERE ID=?";
 seleccionaYActualiza($selSql, $updSql, $db_connection);
 
 //breeders Canada
 echo "breeders canada ...";
 $selSql="SELECT ID, NAME, URL_ENCODED FROM BREEDERS_CANADA";
 $updSql="UPDATE BREEDERS_CANADA SET URL_ENCODED=? WHERE ID=?";
 seleccionaYActualiza($selSql, $updSql, $db_connection);
 
 //breeders China
 echo "breeders canada ...";
 $selSql="SELECT ID, NAME, URL_ENCODED FROM BREEDERS_CHINA";
 $updSql="UPDATE BREEDERS_CHINA SET URL_ENCODED=? WHERE ID=?";
 seleccionaYActualiza($selSql, $updSql, $db_connection);
 
 //shelters Canada
 echo "shelters canada ...";
 $selSql="SELECT ID, NAME, URL_ENCODED FROM SHELTERS_CANADA";
 $updSql="UPDATE SHELTERS_CANADA SET URL_ENCODED=? WHERE ID=?";
 seleccionaYActualiza($selSql, $updSql, $db_connection);
 
 //shelters China
 echo "shelters china ...";
 $selSql="SELECT ID, NAME, URL_ENCODED FROM SHELTERS_CHINA";
 $updSql="UPDATE SHELTERS_CHINA SET URL_ENCODED=? WHERE ID=?";
 seleccionaYActualiza($selSql, $updSql, $db_connection);
 
 //shelters India
 echo "shelters india ...";
 $selSql="SELECT ID, NAME, URL_ENCODED FROM SHELTERS_INDIA";
 $updSql="UPDATE SHELTERS_INDIA SET URL_ENCODED=? WHERE ID=?";
 seleccionaYActualiza($selSql, $updSql, $db_connection);
 
 //shelters Japón
 echo "shelters japón ...";
 $selSql="SELECT ID, NAME, URL_ENCODED FROM SHELTERS_JAPAN";
 $updSql="UPDATE SHELTERS_JAPAN SET URL_ENCODED=? WHERE ID=?";
 seleccionaYActualiza($selSql, $updSql, $db_connection);
 
 //shelters UK
 echo "shelters uk ...";
 $selSql="SELECT ID, NAME, URL_ENCODED FROM SHELTERS_UK";
 $updSql="UPDATE SHELTERS_UK SET URL_ENCODED=? WHERE ID=?";
 seleccionaYActualiza($selSql, $updSql, $db_connection);
 
 //shelters USA
 echo "shelters usa ...";
 $selSql="SELECT ID, NAME, URL_ENCODED FROM SHELTERS_USA";
 $updSql="UPDATE SHELTERS_USA SET URL_ENCODED=? WHERE ID=?";
 seleccionaYActualiza($selSql, $updSql, $db_connection);
 
  //news
 echo "news ...";
 $selSql="SELECT NEWS_ID, NEWS_TITLE, URL_ENCODED FROM NEWS";
 $updSql="UPDATE NEWS SET URL_ENCODED=? WHERE NEWS_ID=?";
 seleccionaYActualiza($selSql, $updSql, $db_connection);
 
  //forums
 echo "forums ...";
 $selSql="SELECT FORUM_ID, FORUM_NAME, ENCODED_NAME FROM PET_FORUMS";
 $updSql="UPDATE PET_FORUMS SET ENCODED_NAME=? WHERE FORUM_ID=?";
 seleccionaYActualiza($selSql, $updSql, $db_connection);
 

 
 

?>
