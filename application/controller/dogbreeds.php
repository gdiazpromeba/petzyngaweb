<?php

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/beans/DogBreed.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/DogBreedsSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/RequestUtils.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/business/dogbreeds/DogBreedUtils.php';
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
    	
    	$letraInicial         = RequestUtils::getValue("letraInicial");
    	$nombreOParte         = RequestUtils::getValue("nombreOParte");
    	$selDogSize           = RequestUtils::getValue("selDogSize");
    	$selDogFeeding        = RequestUtils::getValue("selDogFeeding");
    	$selUpkeep            = RequestUtils::getValue("selUpkeep");
    	
    	
    	$arrTamaños= DogBreedUtils::calculaTamaños($selDogSize);
    	$tamañoDesde=$arrTamaños[0];
    	$tamañoHasta=$arrTamaños[1];
    	
    	$arrUpkeep= DogBreedUtils::calculaUpkeep($selUpkeep);
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
    	 
    	require 'application/views/dogbreeds/headerDogBreeds.php';
    	require 'application/views/dogbreeds/list/index.php';
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

    

    
    
     
 
     public function info($nombre)
     {
     	$nombre=str_replace("_", " ", $nombre);
     	$info=$this->svc->obtienePorNombre($nombre);
     
     	$feedingArmado=DogBreedUtils::armaFeeding($info);
     	 
     	$shelters=$this->svc->selSheltersPorRaza($info->getId());
     
     	// load views. within the views we can echo out $songs and $amount_of_songs easily
     	require 'application/views/dogbreeds/headerDogBreeds.php';
     	require 'application/views/dogbreeds/details/index.php';
     	require 'application/views/_templates/footer.php';
     }
     

     
    
    
    

}
