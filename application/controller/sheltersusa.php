<?php

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/beans/ShelterUsa.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/SheltersUsaSvcImpl.php';
// header("Content-Type: text/plain; charset=utf-8");

class SheltersUsa extends Controller{
	private $svc;
	private static $tamPagina = 12;
	
	public function __construct(){
		$this->svc = new SheltersUsaSvcImpl();
	}
	
	
    /**
     * PAGE: index
     * Puede ser al principio de todo, o cuando se vuelve de un ítem en particular
     */
    public function index(){
    	session_start();
    	
    	//usaZipCode
    	$usaZipCode=null;
    	$usaZipCodePost=null;
    	$usaZipCodeSession=null;
    	
    	
    	if (isset($_POST['usaZipCode'])){
    		$usaZipCodePost=$_POST['usaZipCode'];
    		session_unset();
    	}
    	
    	if (isset($_SESSION['usaZipCode'])){
    		$usaZipCodeSesion=$_SESSION['usaZipCode'];
    	}
    	
    	
    	if (!is_null($usaZipCodePost)){
    		$usaZipCode=$usaZipCodePost;
    	}else if (!empty($usaZipCodeSesion)){
    		$usaZipCode=$usaZipCodeSesion;
    	}
    	 
    	
    	//usaShelterName
    	$usaShelterName=null;
    	$usaShelterNamePost=null;
    	$usaShelterNameSesion=null;
    	 
    	if (isset($_POST['usaShelterName'])){
    		$usaShelterNamePost=$_POST['usaShelterName'];
    		session_unset();
    	}
    	 
    	if (isset($_SESSION['usaShelterName'])){
    		$usaShelterNameSesion=$_SESSION['usaShelterName'];
    	}
    	 
    	//si el nombreOParte cambió, la sesión debe reiniciarse
    	if (!is_null($usaShelterNamePost)  && $usaShelterNamePost!=$usaShelterNameSesion){
    		session_unset();
    	}
    	
    	if (!is_null($usaShelterNamePost)){
    		$usaShelterName=$usaShelterNamePost;
    	}else if (!empty($usaShelterNameSesion)){
    		$usaShelterName=$usaShelterNameSesion;
    	}    	
    	
    	//usaDistance
    	$usaDistance=null;
    	$usaDistancePost=null;
    	$usaDistanceSesion=null;
    	
    	if (isset($_POST['usaDistance'])){
    		$usaDistancePost=$_POST['usaDistance'];
    		session_unset();
    	}
    	
    	if (isset($_SESSION['usaDistance'])){
    		$usaDistanceSesion=$_SESSION['usaDistance'];
    	}
    	
    	//si el usaDistance cambió, la sesión debe reiniciarse
    	if (!is_null($usaDistancePost)  && $usaDistancePost!=$usaDistanceSesion){
    		session_unset();
    	}
    	 
    	if (!is_null($usaDistancePost)){
    		$usaDistance=$usaDistancePost;
    	}else if (!empty($usaDistanceSesion)){
    		$usaDistance=$usaDistanceSesion;
    	}
    	 
   	
    	
    	$latitudeUsa = 0;
    	$longitudeUsa = 0;
    	//si el zipCode existe, transformarlo en latitud y longitud
    	if (!empty($usaZipCode)){
    		$svcZips = new ZipsUsaSvcImpl();
    		$zipBean = $svcZips->obtienePorCodigo($_REQUEST['zipCode']);
    		$latitudeUsa= $zipBean->getLatitude();
    		$longitudeUsa = $zipBean->getLongitude();
    	}
    	
    	$start=0;
    	if (isset($_SESSION['start'])){
    		$start=$_SESSION['start'];
    	}    	
    	
    	 
   	    $shelters=$this->svc->selTodos($usaShelterName, null, $latitudeUsa, $longitudeUsa, $usaDistance, $start, self::$tamPagina);
    	$amountOfUsaShelters=$this->svc->selTodosCuenta($usaShelterName, null, $latitudeUsa, $longitudeUsa, $usaDistance);
    	
    	$_SESSION['usaZipCode']=$usaZipCode;
    	$_SESSION['usaShelterName']=$usaShelterName;
    	$_SESSION['usaDistance']=$usaDistance;
    	$_SESSION['hayAnterior']= $start > 0;
    	$_SESSION['haySiguiente'] =($amountOfUsaShelters> self::$tamPagina);
    	$_SESSION['start'] = $start;
    	$_SESSION['amountOfUsaShelters'] = $amountOfUsaShelters;
    	
//     	echo "letra inicial=" . $letraInicial . " start=" . $start . " nombreOParte" . " selDogSize=" . $selDogSize . " selDogFeeding=" . $selDogFeeding .  " <br/>";
//     	echo "appartments=" . $selAppartments . " kids=" . $selKids .   " upkeep=" . $selUpkeep .  " <br/>";
    	 
    	require 'application/views/_templates/header.php';
    	require 'application/views/sheltersusa/index.php';
    	require 'application/views/_templates/footer.php';  
    }
    
    
    public function siguiente(){
    	session_start();    

    	
    	$usaZipCode = $_SESSION['usaZipCode'];
    	$usaShelterName = $_SESSION['usaShelterName'];
    	$usaDistance = $_SESSION['usaDistance'];
    	
    	$startAnterior = $_SESSION['start'];
    	$start =  $startAnterior + self::$tamPagina;
    	$amountOfUsaShelters = $_SESSION['amountOfUsaShelters'];
    	
    	$shelters = $this->svc->selTodos($usaShelterName, null, $latitudeUsa, $longitudeUsa, $usaDistance, $start, self::$tamPagina);

//     	    	echo "letra inicial=" . $letraInicial . " start=" . $start . " nombreOParte" . " selDogSize=" . $selDogSize . " selDogFeeding=" . $selDogFeeding .  " <br/>";
//     	    	echo "appartments=" . $selAppartments . " kids=" . $selKids .   " upkeep=" . $selUpkeep .  " <br/>";

    	require 'application/views/_templates/header.php';
    	require 'application/views/usaShelters/index.php';
    	require 'application/views/_templates/footer.php';
    }
    
    public function anterior(){
    	session_start();
    	
    	$usaZipCode = $_SESSION['usaZipCode'];
    	$usaShelterName = $_SESSION['usaShelterName'];
    	$usaDistance = $_SESSION['usaDistance'];    	
    	 
    	$startAnterior = $_SESSION['start'];
    	$start =  $startAnterior - self::$tamPagina;
    	$amountOfUsaShelters = $_SESSION['amountOfUsaShelters'];
    
    	
    	$shelters = $this->svc->selTodos($usaShelterName, null, $latitudeUsa, $longitudeUsa, $usaDistance, $start, self::$tamPagina);
    
   	
    	require 'application/views/_templates/header.php';
    	require 'application/views/usaShelters/index.php';
    	require 'application/views/_templates/footer.php';
    
    }
    

}
