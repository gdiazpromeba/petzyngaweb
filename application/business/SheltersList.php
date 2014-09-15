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
		unset($_SESSION['firstArea']);
		$_SESSION['start']=0;
		unset($_SESSION['amountOfShelters']);		
		//countryUrl
		$_REQUEST['country']=$this->countryUrl;
		
		
		$this->lista();
	}
	
    
    private function recogeVariable ($varName){
    	$ret=null;
    	if (isset($_POST[$varName])){
    		$ret=$_POST[$varName];
    		//$_SESSION[$varName]=$ret;
//     	}else if (isset($_SESSION[$varName])){
//             $ret=$_SESSION[$varName];
    	}
    	return $ret;
    }
	
    public function lista(){
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }
    	
        
    	
    	$zipCode         = $this->recogeVariable("zipCode");
    	$shelterName     = $this->recogeVariable("shelterName"); 
    	$distance        = $this->recogeVariable("distance");
        $specialBreedId  = $this->recogeVariable("specialBreedId");    	
        $dogBreedName    = $this->recogeVariable("dogBreedName");
        $firstArea       = $this->recogeVariable("firstArea");
        $secondArea      = $this->recogeVariable("secondArea");
        $secondArea      = $this->recogeVariable("secondArea");
   	
    	
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
    	 
    	
    	$shelters=$this->svc->selTodosWeb($shelterName, $firstArea, $secondArea, $latitude, $longitude, $distance, $specialBreedId, $start, self::$tamPagina);
    	$amountOfShelters=$this->svc->selTodosWebCuenta($shelterName, $firstArea, $secondArea, $latitude, $longitude, $distance, $specialBreedId);
    	$firstAreas = $this->svc->selFirstAreas();
    	
    	$_SESSION['latitude']=$latitude;
    	$_SESSION['longitude']=$longitude;
    	$_REQUEST['hayAnterior']= ($_SESSION['start']  > 0);
    	$_REQUEST['haySiguiente'] =($amountOfShelters > ($_SESSION['start'] + self::$tamPagina));
    	$_SESSION['start'] = $start;
    	$_REQUEST['country'] = $this->countryUrl;
    	$_REQUEST['secondArea'] = $secondArea;
    	
    	
//     	echo "letra inicial=" . $letraInicial . " start=" . $start . " nombreOParte" . " selDogSize=" . $selDogSize . " selDogFeeding=" . $selDogFeeding .  " <br/>";
//     	echo "appartments=" . $selAppartments . " kids=" . $selKids .   " upkeep=" . $selUpkeep .  " <br/>";
    	 
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
