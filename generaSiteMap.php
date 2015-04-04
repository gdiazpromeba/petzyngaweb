<?php

require_once 'config.php';

require_once $GLOBALS['pathCms'] . '/beans/DogBreed.php';
require_once $GLOBALS['pathCms'] . '/svc/impl/DogPurposesSvcImpl.php';
require_once $GLOBALS['pathCms'] . '/svc/impl/DogBreedsSvcImpl.php';
require_once $GLOBALS['pathCms'] . '/svc/impl/SheltersUsaSvcImpl.php';
require_once $GLOBALS['pathCms'] . '/svc/impl/SheltersJapanSvcImpl.php';
require_once $GLOBALS['pathCms'] . '/svc/impl/SheltersCanadaSvcImpl.php';
require_once $GLOBALS['pathCms'] . '/svc/impl/SheltersUkSvcImpl.php';
require_once $GLOBALS['pathCms'] . '/svc/impl/SheltersIndiaSvcImpl.php';
require_once $GLOBALS['pathCms'] . '/svc/impl/SheltersChinaSvcImpl.php';
require_once $GLOBALS['pathCms'] . '/svc/impl/NewsSvcImpl.php';
require_once $GLOBALS['pathCms'] . '/svc/impl/PetForumsSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/UrlUtils.php';


$db_connection = new mysqli("localhost", $GLOBALS['usuario'] , $GLOBALS['clave'] , $GLOBALS['baseDeDatos']);
$db_connection->set_charset("utf8");

function escribeArchivo($nombreArchivo, $contenido){
	$fh = fopen($nombreArchivo, 'w') or die(print_r(error_get_last(),true));
	fwrite($fh, utf8_encode($contenido));
	fclose($fh);
}

function codificaConMas($urlOriginal){
	$ret = str_replace(' ', '+',$urlOriginal);
	$ret = urlencode($ret);
	return $ret;
}

function construyeUnidad($rootUrl, $lastMod, $changeFreq, $priority){
	$res = "   <url>   \n";
	$res .= "     <loc>" . $rootUrl . "</loc>   \n";
	$res .= "     <lastmod>" . $lastMod . "</lastmod>   \n";
	$res .= "     <changefreq>" . $changeFreq . "</changefreq>   \n";
	$res .= "     <priority>" . $priority . "</priority>   \n";
	$res .= "   </url>   \n";
	return $res;
}

$res =  "<?xml version=\"1.0\" encoding=\"UTF-8\"?>   \n";
$res .= "  <?xml-stylesheet type=\"text/xsl\" href=\"gss.xsl\"?>   \n";
$res .= "  <urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.google.com/schemas/sitemap/0.84 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">   \n";

$rootUrl = "http://petzynga.com/";
$lastMod = date("Y-m-d");;

$url= $rootUrl;


//todas las razas cuyo detalle está en la homepage
//páginas individuales de razas caninas
$svc = new DogBreedsSvcImpl();
$beans = $svc->selecciona(null, null, null, null, null, null, null, null,  null, 0, 100000);
$res .= "<!-- dog breeds listing   -->   \n";
foreach ($beans as $bean){
	$url= $rootUrl . "home/breed/" . UrlUtils::codifica($bean->getNameEncoded());
	$res .= construyeUnidad($url, $lastMod, "monthly", 0.5);
}

//menúes de 1er nivel
$url= $rootUrl . "dogbreeds";
$res .= construyeUnidad($url, $lastMod, "monthly", 1);
$url= $rootUrl . "shelters/countries";
$res .= construyeUnidad($url, $lastMod, "monthly", 1);
$url= $rootUrl . "breeders/countries";
$res .= construyeUnidad($url, $lastMod, "monthly", 1);
$url= $rootUrl . "latestnews";
$res .= construyeUnidad($url, $lastMod, "monthly", 1);

//dog breeds
$res .= "<!-- Dog breed groups  -->   \n";
$url= $rootUrl . "dogbreeds/groups";
$res .= construyeUnidad($url, $lastMod, "monthly", 1);

//dog breeds groups
$svcDogPurposes = new DogPurposesSvcImpl();
$beans = $svcDogPurposes->selTodos(0, 10000);
foreach ($beans as $bean){
	$url= $rootUrl . "groups/" .  codificaConMas($bean->getNombre());
	$res .= construyeUnidad($url, $lastMod, "monthly", 0.7);
	
    //and every breed within each group
	$sql= "SELECT  \n";
    $sql.= "  DOG_BREED_NAME, \n";
    $sql.= "  NAME_ENCODED    \n";
    $sql.= "FROM  \n";
    $sql.= "  DOG_BREEDS   \n";
    $sql.= "WHERE     \n";
    $sql.= "  DOG_PURPOSE_ID='" .  $bean->getId() ."'     \n";
       
    if (!$stm2 = $db_connection->prepare($sql)){
       	echo $db_connection->error;
       	exit();
     } 
        

     $stm2->execute();
     $stm2->bind_result($name, $nameEncoded);
     while ($stm2->fetch()) {
       	 $url=   $GLOBALS['dirWeb']  . "/dogbreeds/groups/"  .  urlencode($bean->getNombre()) . "/" . $nameEncoded;
       	 $res .= construyeUnidad($url, $lastMod, "monthly", 0.6);
       }       
       
     $stm2->close();
}

$res .= "<!-- shelters per country  -->   \n";
$paisesShelters = array("usa", "uk", "japan", "canada", "india", "china");

foreach ($paisesShelters as $country){
	$url= $rootUrl . "shelters/listing/" . $country;
	$res .= construyeUnidad($url, $lastMod, "monthly", 1);
	
	$url= $rootUrl . "shelters/search/" . $country;
	$res .= construyeUnidad($url, $lastMod, "monthly", 1);

	//y dentro de los "listing", los shelters individuales
	$sql=null;
	$subdivision=null;
	$area1TypeName=null;
	$area2TypeName=null;
	switch ($country){
		case "usa":
			$subdivision="county";
			$sql= "SELECT  \n";
			$sql.= "  ADMINISTRATIVE_AREA_LEVEL_1, \n";
			$sql.= "  COUNT(*) \n";
			$sql.= "FROM  \n";
			$sql.= "  SHELTERS_USA  \n";
			$sql.= "GROUP BY 1 \n";
			$sql.= "ORDER BY 1  \n";
			$countryName="the United States of America";
			break;
		case "japan":
			$subdivision="locality";
			$sql= "SELECT  \n";
			$sql.= "  ADMINISTRATIVE_AREA_LEVEL_1, \n";
			$sql.= "  COUNT(*) \n";
			$sql.= "FROM  \n";
			$sql.= "  SHELTERS_JAPAN  \n";
			$sql.= "GROUP BY 1 \n";
			$sql.= "ORDER BY 1  \n";
			$countryName="Japan";
			break;
		case "canada":
			$subdivision="subdivision";
			$sql= "SELECT  \n";
			$sql.= "  ADMINISTRATIVE_AREA_LEVEL_1, \n";
			$sql.= "  COUNT(*) \n";
			$sql.= "FROM  \n";
			$sql.= "  SHELTERS_CANADA  \n";
			$sql.= "GROUP BY 1 \n";
			$sql.= "ORDER BY 1  \n";
			$countryName="Canada";
			break;
		case "china":
			$subdivision="locality";
			$sql= "SELECT  \n";
			$sql.= "  ADMINISTRATIVE_AREA_LEVEL_1, \n";
			$sql.= "  COUNT(*) \n";
			$sql.= "FROM  \n";
			$sql.= "  SHELTERS_CHINA  \n";
			$sql.= "GROUP BY 1 \n";
			$sql.= "ORDER BY 1  \n";
			$countryName="China";
			break;
		case "india":
			$subdivision="district";
			$sql= "SELECT  \n";
			$sql.= "  ADMINISTRATIVE_AREA_LEVEL_1, \n";
			$sql.= "  COUNT(*) \n";
			$sql.= "FROM  \n";
			$sql.= "  SHELTERS_INDIA  \n";
			$sql.= "GROUP BY 1 \n";
			$sql.= "ORDER BY 1  \n";
			$countryName="India";
			break;
		case "uk":
			$subdivision="county";
			$sql= "SELECT  \n";
			$sql.= "  ADMINISTRATIVE_AREA_LEVEL_1, \n";
			$sql.= "  COUNT(*) \n";
			$sql.= "FROM  \n";
			$sql.= "  SHELTERS_UK  \n";
			$sql.= "GROUP BY 1 \n";
			$sql.= "ORDER BY 1  \n";
			$countryName="the United Kingdom";
			break;
	}
	if (!$stm = $db_connection->prepare($sql)){
		echo $db_connection->error;
		exit();
	}
	$stm->execute();
	$stm->bind_result($firstArea, $amount);
	while ($stm->fetch()) {
		$url= $GLOBALS["dirWeb"] . "/shelters/listing/" . $country . "/" . urlencode($firstArea) ;
		$res .= construyeUnidad($url, $lastMod, "weekly", 0.5);		
	}
	$stm->close();
}


echo "breeders \n";
$res .= "<!-- breeders per country  -->   \n";
$paisesBreeders = array("usa", "uk",  "canada");

foreach ($paisesBreeders as $country){
	$url= $rootUrl . "breeders/listing/" . $country;
	$res .= construyeUnidad($url, $lastMod, "monthly", 1);

	$url= $rootUrl . "breeders/search/" . $country;
	$res .= construyeUnidad($url, $lastMod, "monthly", 1);
	
	//para cada país, las áreas

	$sql=null;
	$subdivision=null;
	$area1TypeName=null;
	$area2TypeName=null;
	switch ($country){
		case "usa":
			$subdivision="county";
			$sql= "SELECT  \n";
			$sql.= "  ADMINISTRATIVE_AREA_LEVEL_1, \n";
			$sql.= "  COUNT(*) \n";
			$sql.= "FROM  \n";
			$sql.= "  BREEDERS_USA  \n";
			$sql.= "GROUP BY 1 \n";
			$sql.= "ORDER BY 1  \n";
			$countryName="the United States of America";
			break;
		case "canada":
			$subdivision="subdivision";
			$sql= "SELECT  \n";
			$sql.= "  ADMINISTRATIVE_AREA_LEVEL_1, \n";
			$sql.= "  COUNT(*) \n";
			$sql.= "FROM  \n";
			$sql.= "  BREEDERS_CANADA  \n";
			$sql.= "GROUP BY 1 \n";
			$sql.= "ORDER BY 1  \n";
			$countryName="Canada";
			break;
		case "uk":
			$subdivision="county";
			$sql= "SELECT  \n";
			$sql.= "  ADMINISTRATIVE_AREA_LEVEL_1, \n";
			$sql.= "  COUNT(*) \n";
			$sql.= "FROM  \n";
			$sql.= "  BREEDERS_UK  \n";
			$sql.= "GROUP BY 1 \n";
			$sql.= "ORDER BY 1  \n";
			$countryName="the United Kingdom";
			break;
	}
	if (!$stm = $db_connection->prepare($sql)){
		echo $db_connection->error;
		exit();
	}
	$stm->execute();
	$stm->store_result();
	echo "executed area query for " . $countryName;
	$stm->bind_result($firstArea, $amount);
	while ($stm->fetch()) {
		$url = $GLOBALS["dirWeb"] . "/breeders/listing/" . $country . "/" . urlencode($firstArea) ;
		$res .= construyeUnidad($url, $lastMod, "monthly", 0.6);
		
		//raza para cada área
		$sql=null;
		$subdivision=null;
		$area1TypeName=null;
		$area2TypeName=null;
		switch ($country){
			case "usa":
				$sql= "SELECT DISTINCT \n";
				$sql.= "  DOG_BREED_NAME, \n";
				$sql.= "  NAME_ENCODED \n";
				$sql.= "FROM  \n";
				$sql.= "  DOG_BREEDS DB  \n";
				$sql.= "  INNER JOIN DOG_BREEDS_BY_BREEDER X ON X.DOG_BREED_ID = DB.DOG_BREED_ID   \n";
				$sql.= "  INNER JOIN BREEDERS_USA BR ON  X.BREEDER_ID = BR.ID   \n";
				$sql.= "WHERE  \n";
				$sql.= "  BR.ADMINISTRATIVE_AREA_LEVEL_1='" . $firstArea . "'  \n";
				$sql.= "ORDER BY 1  \n";
				$countryName="the United States of America";
				$area1TypeName="State";
				$area2TypeName="County";
				break;
			case "canada":
				$sql= "SELECT DISTINCT \n";
				$sql.= "  DOG_BREED_NAME, \n";
				$sql.= "  NAME_ENCODED \n";
				$sql.= "FROM  \n";
				$sql.= "  DOG_BREEDS DB  \n";
				$sql.= "  INNER JOIN DOG_BREEDS_BY_BREEDER X ON X.DOG_BREED_ID = DB.DOG_BREED_ID   \n";
				$sql.= "  INNER JOIN BREEDERS_CANADA BR ON X.BREEDER_ID = BR.ID   \n";
				$sql.= "WHERE  \n";
				$sql.= "  BR.ADMINISTRATIVE_AREA_LEVEL_1='" . $firstArea . "'  \n";
				$sql.= "ORDER BY 1  \n";
				$countryName="Canada";
				$area1TypeName="Province";
				$area2TypeName="Subdivision";
				break;
			case "uk":
				$sql= "SELECT  DISTINCT \n";
				$sql.= "  DOG_BREED_NAME, \n";
				$sql.= "  NAME_ENCODED \n";
				$sql.= "FROM  \n";
				$sql.= "  DOG_BREEDS DB  \n";
				$sql.= "  INNER JOIN DOG_BREEDS_BY_BREEDER X ON X.DOG_BREED_ID = DB.DOG_BREED_ID   \n";
				$sql.= "  INNER JOIN BREEDERS_UK BR ON X.BREEDER_ID = BR.ID   \n";
				$sql.= "WHERE  \n";
				$sql.= "  BR.ADMINISTRATIVE_AREA_LEVEL_1='" . $firstArea . "'  \n";
				$sql.= "ORDER BY 1  \n";
				$countryName="the United Kingdom";
				$area1TypeName="Province";
				$area2TypeName="Subdivision";
				break;
		}
		if (!$stm2 = $db_connection->prepare($sql)){
			echo $db_connection->error;
			exit();
		}
		$stm2->execute();
		$stm2->store_result();
		echo "executed breed query for " . $firstArea;
		$stm2->bind_result($name, $nameEncoded);

		while ($stm2->fetch()) {
			$url = $GLOBALS["dirWeb"] . "/breeders/listing/" . $country . "/" . urlencode($firstArea) . "/" .   $nameEncoded ;
			$res .= construyeUnidad($url, $lastMod, "monthly", 0.50);
			
			//breeders para cada área y raza
			$sql=null;
			$subdivision=null;
			$area1TypeName=null;
			$breedName=null;
			switch ($country){
				case "usa":
					$sql= "SELECT  \n";
					$sql.= "  BR.NAME, \n";
					$sql.= "  BR.URL_ENCODED, \n";
					$sql.= "  DB.DOG_BREED_NAME \n";
					$sql.= "FROM  \n";
					$sql.= "  DOG_BREEDS DB  \n";
					$sql.= "  INNER JOIN DOG_BREEDS_BY_BREEDER X ON X.DOG_BREED_ID = DB.DOG_BREED_ID   \n";
					$sql.= "  INNER JOIN BREEDERS_USA BR ON  X.BREEDER_ID = BR.ID   \n";
					$sql.= "WHERE  \n";
					$sql.= "  BR.ADMINISTRATIVE_AREA_LEVEL_1='" . $firstArea . "'  \n";
					$sql.= "  AND DB.NAME_ENCODED='" . $nameEncoded . "'  \n";
					$sql.= "ORDER BY 1  \n";
					$countryName="the United States of America";
					$area1TypeName="State";
					$area2TypeName="County";
					break;
				case "canada":
					$sql= "SELECT  \n";
					$sql.= "  BR.NAME, \n";
					$sql.= "  BR.URL_ENCODED, \n";
					$sql.= "  DB.DOG_BREED_NAME \n";
					$sql.= "FROM  \n";
					$sql.= "  DOG_BREEDS DB  \n";
					$sql.= "  INNER JOIN DOG_BREEDS_BY_BREEDER X ON X.DOG_BREED_ID = DB.DOG_BREED_ID   \n";
					$sql.= "  INNER JOIN BREEDERS_CANADA BR ON  X.BREEDER_ID = BR.ID   \n";
					$sql.= "WHERE  \n";
					$sql.= "  BR.ADMINISTRATIVE_AREA_LEVEL_1='" . $firstArea . "'  \n";
					$sql.= "  AND DB.NAME_ENCODED='" . $nameEncoded . "'  \n";
					$sql.= "ORDER BY 1  \n";
					$countryName="Canada";
					$area1TypeName="Province";
					$area2TypeName="Subdivision";
					break;
				case "uk":
					$sql= "SELECT  \n";
					$sql.= "  BR.NAME, \n";
					$sql.= "  BR.URL_ENCODED, \n";
					$sql.= "  DB.DOG_BREED_NAME \n";
					$sql.= "FROM  \n";
					$sql.= "  DOG_BREEDS DB  \n";
					$sql.= "  INNER JOIN DOG_BREEDS_BY_BREEDER X ON X.DOG_BREED_ID = DB.DOG_BREED_ID   \n";
					$sql.= "  INNER JOIN BREEDERS_UK BR ON  X.BREEDER_ID = BR.ID   \n";
					$sql.= "WHERE  \n";
					$sql.= "  BR.ADMINISTRATIVE_AREA_LEVEL_1='" . $firstArea . "'  \n";
					$sql.= "  AND DB.NAME_ENCODED='" . $nameEncoded . "'  \n";
					$sql.= "ORDER BY 1  \n";
					$countryName="the United Kingdom";
					$area1TypeName="Country";
					$area2TypeName="County";
					break;
			}
			if (!$stm3 = $db_connection->prepare($sql)){
				echo $db_connection->error;
				exit();
			}
			echo "executed breeder query for " . $firstArea;
			$stm3->execute();
			$stm3->store_result();
			$stm3->bind_result($shelterName, $shelterNameEncoded, $dogBreedName);
			while ($stm3->fetch()) {
				$url = $GLOBALS["dirWeb"] . "/breeders/info/" . $country . "/" .  $shelterNameEncoded ;
				$res .= construyeUnidad($url, $lastMod, "monthly", 0.50);
			}
			$stm3->free_result();
			$stm3->close();
		}
		$stm2->free_result();
		$stm2->close();
	}
	$stm->free_result();
	$stm->close();
}



//news individuales
$res .= "<!-- news    -->   \n";
$svc = new NewsSvcImpl();
$beans =  $svc->selTodos(null, 0, 10000);
$url= $rootUrl . "latestnews/list";
$res .= construyeUnidad($url, $lastMod, "weekly", 0.5);
foreach ($beans as $bean){
	$url= $rootUrl . "latestnews/info/" . $bean->getUrlEncoded() ;
	$res .= construyeUnidad($url, $lastMod, "monthly", 0.5);
}

$db_connection->close();


$res .="</urlset>";

escribeArchivo("sitemap.xml", $res);
  
?>
