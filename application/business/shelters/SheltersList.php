<?php


// header("Content-Type: text/plain; charset=utf-8");

class SheltersList {
	private $svc;
	private $svcZips;
	private static $tamPagina = 12;
	private $countryUrl;
	private $distanceUnit;
	private $conversionFactor;
	private $headerTextKey;
	private $headerTitleKey;
	

	public function __construct($countryUrl, $headerTitleKey, $headerTextKey, $distanceUnit, $conversionFactor, $svc, $svcZips){
		$this->svc = $svc;
		$this->svcZips = $svcZips;
		$this->countryUrl = $countryUrl;
		$this->headerTitleKey = $headerTitleKey;
		$this->headerTextKey = $headerTextKey;
		$this->distanceUnit = $distanceUnit;
		$this->conversionFactor = $conversionFactor;
	}
	
	
	public function inicia(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$_REQUEST['start']=0;
		$_REQUEST['country']=$this->countryUrl;
		
		
		$this->lista();
	}
	
    
    private function recogeVariable ($varName){
    	$ret=null;
    	if (isset($_REQUEST[$varName])){
    		$ret=$_REQUEST[$varName];
    	}
    	$_REQUEST[$varName]=$ret;
    	
    	return $ret;
    }
	
    public function lista(){
    	$zipCode         = $this->recogeVariable("zipCode");
    	$shelterName     = $this->recogeVariable("shelterName"); 
    	$distance        = $this->recogeVariable("distance");
        $specialBreedId  = $this->recogeVariable("specialBreedId");    	
        $dogBreedName    = $this->recogeVariable("dogBreedName");
        $firstArea       = $this->recogeVariable("firstArea");
        $secondArea      = $this->recogeVariable("secondArea");
        
   	
//     	echo " el countryUrl es = " . $this->countryUrl;
        
    	$latitude = 0;
    	$longitude = 0;
    	//si el zipCode existe, transformarlo en latitud y longitud
    	if (!empty($zipCode)){
    		$svcZips = new ZipsGenericoSvcImpl();
    		$zipBean = $svcZips->obtienePorCodigo(strtoupper($this->countryUrl), $zipCode);
    		$latitude= $zipBean->getLatitude();
    		$longitude = $zipBean->getLongitude();
    	}
    	
    	
    	if (!isset($_REQUEST['start'])){
    		$_REQUEST['start']=0;
    	}
    	$start=$_REQUEST['start'];
    	
    	
    	$shelters=$this->svc->selTodosWeb($shelterName, $firstArea, $secondArea, $latitude, $longitude, $distance, $specialBreedId, $start, self::$tamPagina);
    	$amountOfShelters=$this->svc->selTodosWebCuenta($shelterName, $firstArea, $secondArea, $latitude, $longitude, $distance, $specialBreedId);
    	$firstAreas = $this->svc->selFirstAreas();
    	
//     	echo "firstArea=" . $firstArea . " secondArea=" . $secondArea . " amount=" . $amountOfShelters . "  specialBreedId=" . $specialBreedId; 
    	
    	
    	$_REQUEST['hayAnterior']= ($_REQUEST['start']  > 0);
    	$_REQUEST['haySiguiente'] =($amountOfShelters > ($_REQUEST['start'] + self::$tamPagina));
    	
    	 
    	$_REQUEST['country'] = $this->countryUrl;
    	$distanceUnit= $this->distanceUnit;
    	$conversionFactor= $this->conversionFactor;
    	$headerTitleKey = $this->headerTitleKey;
    	$headerTextKey = $this->headerTextKey;
    	require 'application/views/shelters/list/headerSheltersIndex.php';
    	require 'application/views/shelters/list/index.php';
    	require 'application/views/_templates/footer.php';  
    }
    
    
    public function siguiente(){
    	$_REQUEST['start'] = $_REQUEST['start'] + self::$tamPagina;
    	$this->lista();
    }
    
    public function anterior(){
    	$_REQUEST['start']= $_REQUEST['start']- self::$tamPagina;;
    	$this->lista();
    }
    

}
