<?php


// header("Content-Type: text/plain; charset=utf-8");

class SheltersList {
	private $svc;
	private $svcZips;
	private static $tamPagina = 12;
	private $countryUrl;
	private $distanceUnit;
	private $conversionFactor;
	

	public function __construct($countryUrl, $distanceUnit, $conversionFactor, $svc, $svcZips){
		$this->svc = $svc;
		$this->svcZips = $svcZips;
		$this->countryUrl = $countryUrl;
		$this->distanceUnit = $distanceUnit;
		$this->conversionFactor = $conversionFactor;
	}
	
	
	public function inicia(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		unset($_SESSION['zipCode']);
		unset($_SESSION['shelterName']);
		unset($_SESSION['distance']);
		unset($_SESSION['latitude']);
		unset($_SESSION['longitude']);
		unset($_SESSION['specialBreedId']);
		unset($_SESSION['dogBreedName']);
		unset($_SESSION['hayAnterior']);
		unset($_SESSION['haySiguiente']);
		$_SESSION['start']=0;
		unset($_SESSION['amountOfShelters']);		
		$this->lista();
	}
	
    public function lista(){
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }
    	
    	//zipCode
    	$zipCode=null;
    	$zipCodePost=null;
    	$zipCodeSession=null;
    	
    	
    	if (isset($_POST['zipCode'])){
    		$zipCodePost=$_POST['zipCode'];
    		session_unset();
    	}
    	
    	if (isset($_SESSION['zipCode'])){
    		$zipCodeSesion=$_SESSION['zipCode'];
    	}
    	
    	
    	if (!is_null($zipCodePost)){
    		$zipCode=$zipCodePost;
    	}else if (!empty($zipCodeSesion)){
    		$zipCode=$zipCodeSesion;
    	}
    	 
    	
    	//shelterName
    	$shelterName=null;
    	$shelterNamePost=null;
    	$shelterNameSesion=null;
    	 
    	if (isset($_POST['shelterName'])){
    		$shelterNamePost=$_POST['shelterName'];
    		session_unset();
    	}
    	 
    	if (isset($_SESSION['shelterName'])){
    		$shelterNameSesion=$_SESSION['shelterName'];
    	}
    	 
    	//si el nombreOParte cambió, la sesión debe reiniciarse
    	if (!is_null($shelterNamePost)  && $shelterNamePost!=$shelterNameSesion){
    		session_unset();
    	}
    	
    	if (!is_null($shelterNamePost)){
    		$shelterName=$shelterNamePost;
    	}else if (!empty($shelterNameSesion)){
    		$shelterName=$shelterNameSesion;
    	}    	
    	
    	//distance
    	$distance=null;
    	$distancePost=null;
    	$distanceSesion=null;
    	
    	if (isset($_POST['distance'])){
    		$distancePost=$_POST['distance'];
    		session_unset();
    	}
    	
    	if (isset($_SESSION['distance'])){
    		$distanceSesion=$_SESSION['distance'];
    	}
    	
    	//si el distance cambió, la sesión debe reiniciarse
    	if (!is_null($distancePost)  && $distancePost!=$distanceSesion){
    		session_unset();
    	}
    	 
    	if (!is_null($distancePost)){
    		$distance=$distancePost;
    	}else if (!empty($distanceSesion)){
    		$distance=$distanceSesion;
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
    	 
   	
    	
    	$latitude = 0;
    	$longitude = 0;
    	//si el zipCode existe, transformarlo en latitud y longitud
    	if (!empty($zipCode)){
    		$svcZips = new ZipsGenericoSvcImpl();
    		$zipBean = $svcZips->obtienePorCodigo(strtoupper($this->countryUrl), $zipCode);
    		$latitude= $zipBean->getLatitude();
    		$longitude = $zipBean->getLongitude();
    	}
    	
    	$start=0;
    	if (!isset($_SESSION['start'])){
    		$_SESSION['start']=0;
    	}
    	$start=$_SESSION['start'];
    	 
   	    $shelters=$this->svc->selTodosWeb($shelterName, $latitude, $longitude, $distance, $specialBreedId, $start, self::$tamPagina);
    	$amountOfShelters=$this->svc->selTodosWebCuenta($shelterName, $latitude, $longitude, $distance, $specialBreedId);
    	
    	$_SESSION['zipCode']=$zipCode;
    	$_SESSION['shelterName']=$shelterName;
    	$_SESSION['distance']=$distance;
    	$_SESSION['latitude']=$latitude;
    	$_SESSION['longitude']=$longitude;
    	$_SESSION['specialBreedId']=$specialBreedId;
    	$_SESSION['dogBreedName']=$dogBreedName;
    	$_SESSION['hayAnterior']= ($_SESSION['start']  > 0);
    	$_SESSION['haySiguiente'] =($amountOfShelters > ($_SESSION['start'] + self::$tamPagina));
    	$_SESSION['start'] = $start;
    	$_SESSION['amountOfShelters'] = $amountOfShelters;
    	
    	
//     	echo "letra inicial=" . $letraInicial . " start=" . $start . " nombreOParte" . " selDogSize=" . $selDogSize . " selDogFeeding=" . $selDogFeeding .  " <br/>";
//     	echo "appartments=" . $selAppartments . " kids=" . $selKids .   " upkeep=" . $selUpkeep .  " <br/>";
    	 
    	$countryUrl= $this->countryUrl;
    	$distanceUnit= $this->distanceUnit;
    	$conversionFactor= $this->conversionFactor;
    	require 'application/views/shelters/list/headerSheltersIndex.php';
    	require 'application/views/shelters/list/index.php';
    	require 'application/views/_templates/footer.php';  
    }
    
    
    public function siguiente(){
    	if (session_status() == PHP_SESSION_NONE) {
    		session_start();
    	}    	
    	
    	$_SESSION['start'] = $_SESSION['start'] + self::$tamPagina;
    	$this->lista();
    }
    
    public function anterior(){
    	if (session_status() == PHP_SESSION_NONE) {
    		session_start();
    	}    	
   	
    	$_SESSION['start']= $_SESSION['start']- self::$tamPagina;;
    	$this->lista();
    }
    

}
