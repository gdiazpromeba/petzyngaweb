<?php


// header("Content-Type: text/plain; charset=utf-8");

class SheltersList {
	public $svc;
	public $svcZips;
	public static $tamPagina = 12;
	public $countryUrl;
	public $distanceUnit;
	public $conversionFactor;
	public $headerTextKey;
	public $headerTitleKey;
	public $metaDescriptionKey;
	public $metaKeywordsKey;
	
	private $area1Value;
	private $area1Field;
	private $area2Value;
	private $area2Field;
	

	public function __construct($countryUrl, $headerTitleKey, $headerTextKey,  $metaDescriptionKey, $metaKeywordsKey,  $distanceUnit, $conversionFactor, $svc, $svcZips){
		$this->svc = $svc;
		$this->svcZips = $svcZips;
		$this->countryUrl = $countryUrl;
		$this->headerTitleKey = $headerTitleKey;
		$this->headerTextKey = $headerTextKey;
		$this->metaDescriptionKey = $metaDescriptionKey;
		$this->metaKeywordsKey = $metaKeywordsKey;
		$this->distanceUnit = $distanceUnit;
		$this->conversionFactor = $conversionFactor;
	}
	
	public function setAreas($area1Field, $area1Value, $area2Field, $area2Value){
		$this->area1Field = $area1Field;
		$this->area1Value = $area1Value;
		$this->area2Field = $area2Field;
		$this->area2Value = $area2Value;
	}
	
	
	public function iniciaAvanzada(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$_REQUEST['start']=0;
		$_REQUEST['country']=$this->countryUrl;
		
		
		$this->listaAvanzada();
	}
	
	public function iniciaRegional(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$_REQUEST['country']=$this->countryUrl;
		$this->listaRegional();
	}	
	
    
    private function recogeVariable ($varName){
    	$ret=null;
    	if (isset($_REQUEST[$varName])){
    		$ret=$_REQUEST[$varName];
    	}
    	$_REQUEST[$varName]=$ret;
    	
    	return $ret;
    }
    
    public function listaRegional(){
    	 
    	$shelters=$this->svc->selTodosWeb(null, null, null, 0, 0, null, null, 0, 10000);
    	$amountOfShelters=$this->svc->selTodosWebCuenta(null, null, null, 0, 0, null, null);
    	$firstAreas = $this->svc->selFirstAreas();

    	//create a map with areas=>array of shelters
    	$mapAreas=array();
    	foreach ($shelters as $shelter){
    		if (!isset($mapAreas[$shelter->getAdminArea1()])){
    			$mapAreas[$shelter->getAdminArea1()]=array();
    		}
    		$mapAreas[$shelter->getAdminArea1()][]=$shelter;
    	}
    	 
    	$arrayAreas=array_keys($mapAreas);    
    	sort($arrayAreas);	
    	 
    	 
    
    	$_REQUEST['country'] = $this->countryUrl;
    	$headerTitleKey = $this->headerTitleKey;
    	$headerTextKey = $this->headerTextKey;
    	$metaDescriptionKey = $this->metaDescriptionKey;
    	$metaKeywordsKey = $this->metaKeywordsKey;
    	require 'application/views/shelters/regionallist/header.php';
    	require 'application/views/shelters/regionallist/index.php';
    	require 'application/views/_templates/footer.php';
    }    
	
    public function listaAvanzada(){

        $firstAreas = $this->svc->selFirstAreas();
        $firstArea      = $this->recogeVariable("firstArea");
        $secondArea      = $this->recogeVariable("secondArea");

    	
    	 
    	$_REQUEST['country'] = $this->countryUrl;
    	$distanceUnit= $this->distanceUnit;
    	$conversionFactor= $this->conversionFactor;
    	$headerTitleKey = $this->headerTitleKey;
    	$headerTextKey = $this->headerTextKey;
    	$metaDescriptionKey = $this->metaDescriptionKey;
    	$metaKeywordsKey = $this->metaKeywordsKey;
    	$selectionUrl = $GLOBALS["dirAplicacion"] . "/svc/conector/shelters" . ucfirst($this->countryUrl) . ".php/seleccionaUniversal";
    	require 'application/views/shelters/list/headerSheltersIndex.php';
    	require 'application/views/shelters/list/index.php';
    	require 'application/views/_templates/footer.php';  
    }
    
    
    public function listAreas(){
 
    	$firstArea       = $this->recogeVariable("firstArea");
    	$secondArea      = $this->recogeVariable("secondArea");
    
    	 
    	$shelters=$this->svc->selTodosWeb(null, $firstArea, $secondArea, 0, 0, null, null, 0, 10000);
    	$amountOfShelters=$this->svc->selTodosWebCuenta(null, $firstArea, $secondArea, 0, 0, null, null);
    	$firstAreas = $this->svc->selFirstAreas();
    	 
    	$_REQUEST['country'] = $this->countryUrl;
    	$conversionFactor= $this->conversionFactor;
    	$headerTitleKey = $this->headerTitleKey;
    	$headerTextKey = $this->headerTextKey;
    	$metaDescriptionKey = $this->metaDescriptionKey;
    	$metaKeywordsKey = $this->metaKeywordsKey;
    	require 'application/views/shelters/areasList/header.php';
    	require 'application/views/shelters/areasList/index.php';
    	require 'application/views/_templates/footer.php';
    }
    

    

}
