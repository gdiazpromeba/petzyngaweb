<?php

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/beans/DogBreed.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/DogBreedsSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/RequestUtils.php';
// header("Content-Type: text/plain; charset=utf-8");

/**
 * Class Songs
 * This is a demo class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class DogBreeds extends Controller{
	private $svc;
	private static $tamPagina = 16;
	
	public function __construct(){
		$this->svc = new DogBreedsSvcImpl();
	}
	
	
	public function index(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$_REQUEST['start']=0;
		
		$this->lista();
	}
	
	
    public function lista(){
    	
    	$letraInicial         = $this->recogeVariable("letraInicial");
    	$nombreOParte         = $this->recogeVariable("nombreOParte");
    	$selDogSize           = $this->recogeVariable("selDogSize");
    	$selDogFeeding        = $this->recogeVariable("selDogFeeding");
    	$selUpkeep            = $this->recogeVariable("selUpkeep");
    	
    	
    	$arrTamaños= $this->calculaTamaños($selDogSize);
    	$tamañoDesde=$arrTamaños[0];
    	$tamañoHasta=$arrTamaños[1];
    	
    	$arrUpkeep= $this->calculaUpkeep($selUpkeep);
    	$upkeepDesde=$arrUpkeep[0];
    	$upkeepHasta=$arrUpkeep[1];
    	
    	
    	if (RequestUtils::notSetOrEmpty('start')){
    		$_REQUEST['start']=0;
    	}
    	$start=$_REQUEST['start'];
    	

    	 
   	    $dogBreeds=$this->svc->selecciona($nombreOParte, $letraInicial, $tamañoDesde, $tamañoHasta, $selDogFeeding, null, null, $upkeepDesde, $upkeepHasta, $start, self::$tamPagina);
    	$amountOfDogBreeds=$this->svc->seleccionaCuenta($nombreOParte, $letraInicial, $tamañoDesde, $tamañoHasta, $selDogFeeding, null, null, $upkeepDesde, $upkeepHasta);
    	
    	$_REQUEST['hayAnterior']= ($_REQUEST['start']  > 0);
    	$_REQUEST['haySiguiente'] =($amountOfDogBreeds > ($_REQUEST['start'] + self::$tamPagina));
    	
//     	echo "letra inicial=" . $letraInicial . " start=" . $start . " nombreOParte" . " selDogSize=" . $selDogSize . " selDogFeeding=" . $selDogFeeding .  " <br/>";
//     	echo "hayAnterior=" . $_REQUEST['hayAnterior'] . " haySiguiente=" . $_REQUEST['haySiguiente'] .   " amountOfDogBreeds=" . $amountOfDogBreeds .  " <br/>";
    	 
    	require 'application/views/_templates/headerDogBreeds.php';
    	require 'application/views/dogbreeds/index.php';
    	require 'application/views/_templates/footer.php';  
    }
    
    private function recogeVariable ($varName){
    	$ret=null;
    	if (isset($_REQUEST[$varName])){
    		$ret=$_REQUEST[$varName];
    	}
    	
    	$_REQUEST[$varName]=$ret;
    	
    	return $ret;
    }
    
    
    public function siguiente(){
    	$_REQUEST['start'] = $_REQUEST['start'] + self::$tamPagina;
    	$this->lista();
    }
    
    public function anterior(){
    	$_REQUEST['start']= $_REQUEST['start']- self::$tamPagina;;
    	$this->lista();
    }

    
    private function calculaTamaños($selDogSize){
    	$tamañoDesde=0;
    	$tamañoHasta=100;
    	 
    	switch($selDogSize){
    		case "large":
    			$tamañoDesde=60;
    			$tamañoHasta=60;
    			break;
    		case "medium":
    			$tamañoDesde=50;
    			$tamañoHasta=50;
    			break;
    		case "small":
    			$tamañoDesde=30;
    			$tamañoHasta=30;
    			break;
    		case "toy":
    			$tamañoDesde=20;
    			$tamañoHasta=20;
    			break;    			
    		default:
    			$tamañoDesde=0;
    			$tamañoHasta=100;
    			break;
    	}
    	return array($tamañoDesde, $tamañoHasta);
    	    	
    }
    
    private function calculaUpkeep($selUpkeep){
    	$upkeepDesde=1;
    	$upkeepHasta=5;
    	switch($selUpkeep){
    		case "little":
		    	$upkeepDesde=1;
		    	$upkeepHasta=2;
    			break;
    		case "average":
		    	$upkeepDesde=3;
		    	$upkeepHasta=3;
    			break;
    		case "a lot":
		    	$upkeepDesde=4;
		    	$upkeepHasta=5;
    			break;
    	}
    	return array($upkeepDesde, $upkeepHasta);
     }    
     
     /**
      * PAGE: index
      * This method handles what happens when you move to http://yourproject/songs/index
      */
     public function info($nombre)
     {
     	$nombre=str_replace("_", " ", $nombre);
     	$info=$this->svc->obtienePorNombre($nombre);
     
     	$feedingArmado=$this->armaFeeding($info);
     	 
     	$shelters=$this->svc->selSheltersPorRaza($info->getId());
     
     	// load views. within the views we can echo out $songs and $amount_of_songs easily
     	require 'application/views/_templates/headerDogBreeds.php';
     	require 'application/views/dogbreedinfo/index.php';
     	require 'application/views/_templates/footer.php';
     }
     
     /**
      * toma los valores de serving Min y Max
      * @param unknown $info
      */
     private function armaFeeding($info){
     	$min= $info->getServingMin();
     	$max= $info->getServingMax();
     
     	if ($min!=$max){
     		$res= $this->trataFracciones($min);
     		$res .=" to " . $this->trataFracciones($max);
     		$res .=" cups of quality dry food, twice a day";
     	}else{
     		$res= $this->trataFracciones($min);
     		$res .=" cups of quality dry food, twice a day";
     	}
     	return $res;
     }
     
     /**
      * convierte el n�mero decimal a una cadena con valor fraccionario
      * @param unknown $numero
      */
     private function trataFracciones($numero){
     	$intpart = floor( $numero ) ;
     	$fraction = $numero - $intpart;
     	$fraccionStr="";
     	if ($fraction!=0){
     		switch($fraction){
     			case 0.5:
     				$fraccionStr="½";
     				break;
     			case 0.25:
     				$fraccionStr="¼";
     				break;
     			case 0.75:
     				$fraccionStr="¾";
     				break;
     			default:
     				$fraccionStr=(string)$fraction;
     		}
     	}
     	 
     	if ($intpart==0){
     		return $fraccionStr;
     	}else{
     		return (string)$intpart . $fraccionStr;
     	}
     }     
    
    

}
