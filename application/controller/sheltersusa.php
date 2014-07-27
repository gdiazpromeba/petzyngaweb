<?php

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/beans/ShelterUsa.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/SheltersUsaSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/ZipsUsaSvcImpl.php';
// header("Content-Type: text/plain; charset=utf-8");

class SheltersUsa extends Controller{
	private $svc;
	private $svcZips;
	private static $tamPagina = 12;
	

	public function __construct(){
		$this->svc = new SheltersUsaSvcImpl();
		$this->svcZips = new ZipsUsaSvcImpl();
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
    	
    	//specialBreedId
    	$specialBreedId=null;
    	$specialBreedIdPost=null;
    	$specialBreedIdSession=null;
    	 
    	 
    	if (isset($_POST['specialBreedId'])){
    		$specialBreedIdPost=$_POST['specialBreedId'];
    		session_unset();
    	}
    	 
    	if (isset($_SESSION['specialBreedId'])){
    		$specialBreedIdSesion=$_SESSION['specialBreedId'];
    	}
    	 
    	 
    	if (!is_null($specialBreedIdPost)){
    		$specialBreedId=$specialBreedIdPost;
    	}else if (!empty($specialBreedIdSesion)){
    		$specialBreedId=$specialBreedIdSesion;
    	} 

    	//dogBreedName
    	$dogBreedName=null;
    	$dogBreedNamePost=null;
    	$dogBreedNameSession=null;
    	
    	
    	if (isset($_POST['dogBreedName'])){
    		$dogBreedNamePost=$_POST['dogBreedName'];
    		session_unset();
    	}
    	
    	if (isset($_SESSION['dogBreedName'])){
    		$dogBreedNameSesion=$_SESSION['dogBreedName'];
    	}
    	
    	
    	if (!is_null($dogBreedNamePost)){
    		$dogBreedName=$dogBreedNamePost;
    	}else if (!empty($dogBreedNameSesion)){
    		$dogBreedName=$dogBreedNameSesion;
    	}    	
    	 
   	
    	
    	$usaLatitude = 0;
    	$usaLongitude = 0;
    	//si el zipCode existe, transformarlo en latitud y longitud
    	if (!empty($usaZipCode)){
    		$svcZips = new ZipsUsaSvcImpl();
    		$zipBean = $svcZips->obtienePorCodigo($usaZipCode);
    		$usaLatitude= $zipBean->getLatitude();
    		$usaLongitude = $zipBean->getLongitude();
    	}
    	
    	$start=0;
    	if (isset($_SESSION['start'])){
    		$start=$_SESSION['start'];
    	}    	
    	
    	 
   	    $shelters=$this->svc->selTodos($usaShelterName, null, $usaLatitude, $usaLongitude, $usaDistance, $specialBreedId, $start, self::$tamPagina);
    	$amountOfUsaShelters=$this->svc->selTodosCuenta($usaShelterName, null, $usaLatitude, $usaLongitude, $usaDistance, $specialBreedId);
    	
    	$_SESSION['usaZipCode']=$usaZipCode;
    	$_SESSION['usaShelterName']=$usaShelterName;
    	$_SESSION['usaDistance']=$usaDistance;
    	$_SESSION['usaLatitude']=$usaLatitude;
    	$_SESSION['usaLongitude']=$usaLongitude;
    	$_SESSION['specialBreedId']=$specialBreedId;
    	$_SESSION['dogBreedName']=$dogBreedName;
    	$_SESSION['hayAnterior']= $start > 0;
    	$_SESSION['haySiguiente'] =($amountOfUsaShelters> self::$tamPagina);
    	$_SESSION['start'] = $start;
    	$_SESSION['amountOfUsaShelters'] = $amountOfUsaShelters;
    	
    	
//     	echo "letra inicial=" . $letraInicial . " start=" . $start . " nombreOParte" . " selDogSize=" . $selDogSize . " selDogFeeding=" . $selDogFeeding .  " <br/>";
//     	echo "appartments=" . $selAppartments . " kids=" . $selKids .   " upkeep=" . $selUpkeep .  " <br/>";
    	 
    	require 'application/views/sheltersusa/headerSheltersUsaIndex.php';
    	require 'application/views/sheltersusa/index.php';
    	require 'application/views/_templates/footer.php';  
    }
    
    
    public function siguiente(){
    	session_start();    

    	
    	$usaZipCode = $_SESSION['usaZipCode'];
    	$usaShelterName = $_SESSION['usaShelterName'];
    	$usaDistance = $_SESSION['usaDistance'];
    	$usaLatitude = $_SESSION['usaLatitude'];
    	$usaLongitude = $_SESSION['usaLongitude'];
    	$specialBreedId = $_SESSION['specialBreedId'];
    	$dogBreedName = $_SESSION['dogBreedName'];
    	
    	$startAnterior = $_SESSION['start'];
    	$start =  $startAnterior + self::$tamPagina;
    	$amountOfUsaShelters = $_SESSION['amountOfUsaShelters'];
    	
    	$shelters = $this->svc->selTodos($usaShelterName, null, $usaLatitude, $usaLongitude, $usaDistance, $specialBreedId, $start, self::$tamPagina);
    	
    	$_SESSION['hayAnterior']= true;
    	$_SESSION['haySiguiente'] =($amountOfUsaShelters> ($start + self::$tamPagina));
    	$_SESSION['start'] = $start;    	

//     	    	echo "letra inicial=" . $letraInicial . " start=" . $start . " nombreOParte" . " selDogSize=" . $selDogSize . " selDogFeeding=" . $selDogFeeding .  " <br/>";
//     	    	echo "appartments=" . $selAppartments . " kids=" . $selKids .   " upkeep=" . $selUpkeep .  " <br/>";

    	require 'application/views/sheltersusa/headerSheltersUsaIndex.php';
    	require 'application/views/sheltersusa/index.php';
    	require 'application/views/_templates/footer.php';
    }
    
    public function anterior(){
    	session_start();
    	
    	$usaZipCode = $_SESSION['usaZipCode'];
    	$usaShelterName = $_SESSION['usaShelterName'];
    	$usaDistance = $_SESSION['usaDistance'];    
    	$usaLatitude = $_SESSION['usaLatitude'];
    	$usaLongitude = $_SESSION['usaLongitude'];
    	$specialBreedId = $_SESSION['specialBreedId'];
    	$dogBreedName = $_SESSION['dogBreedName'];
    	 
    	 
    	$startAnterior = $_SESSION['start'];
    	$start =  $startAnterior - self::$tamPagina;
    	$amountOfUsaShelters = $_SESSION['amountOfUsaShelters'];
    	
   	
    	$shelters = $this->svc->selTodos($usaShelterName, null, $usaLatitude, $usaLongitude, $usaDistance, $specialBreedId, $start, self::$tamPagina);

    	$_SESSION['hayAnterior']= $start > 0;
    	$_SESSION['haySiguiente'] = true;
    	$_SESSION['start'] = $start;    	
   	
    	require 'application/views/sheltersusa/headerSheltersUsaIndex.php';
    	require 'application/views/sheltersusa/index.php';
    	require 'application/views/_templates/footer.php';
    
    }
    

}
