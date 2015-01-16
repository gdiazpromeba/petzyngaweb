<?php

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/beans/DogBreed.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/DogBreedsSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/PetForumsSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/RequestUtils.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/UrlUtils.php';
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
	private $svcForums;
	private static $tamPagina = 16;
	
	public function __construct(){
		$this->svc = new DogBreedsSvcImpl();
		$this->svcForums = new PetForumsSvcImpl();
	}
	
	
	public function index(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	
		$this->listaAlfa();
	}
	
	
    public function advancedSearch(){
    	
    	if (RequestUtils::notSetOrEmpty('start')){
    		$start=0;
    	}else{
    		$start = $_REQUEST['start'];
    	}
    	
        if (!RequestUtils::notSetOrEmpty('navegacion')){
    		$navegacion=$_REQUEST['navegacion'];
    		if ($navegacion=="siguiente"){
    			$start = $start + self::$tamPagina;
    		}else if ($navegacion=="anterior"){
    			$start= $start - self::$tamPagina;;
    		}
    	}
    	$_REQUEST['start']=$start;
    	
    	
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
	 
   	    $dogBreeds=$this->svc->selecciona($nombreOParte, $letraInicial, $tamañoDesde, $tamañoHasta, $selDogFeeding, null, null, $upkeepDesde, $upkeepHasta, $start, self::$tamPagina);
    	$amountOfDogBreeds=$this->svc->seleccionaCuenta($nombreOParte, $letraInicial, $tamañoDesde, $tamañoHasta, $selDogFeeding, null, null, $upkeepDesde, $upkeepHasta);
    	
    	$_REQUEST['hayAnterior']= ($start  > 0);
    	$_REQUEST['haySiguiente'] =($amountOfDogBreeds > ($start + self::$tamPagina));
    	
//     	echo "letra inicial=" . $letraInicial . " start=" . $start . " nombreOParte" . " selDogSize=" . $selDogSize . " selDogFeeding=" . $selDogFeeding .  " <br/>";
//     	echo "hayAnterior=" . $_REQUEST['hayAnterior'] . " haySiguiente=" . $_REQUEST['haySiguiente'] .   " amountOfDogBreeds=" . $amountOfDogBreeds .  " <br/>";
    	 
    	require 'application/views/dogbreeds/headerDogBreeds.php';
    	require 'application/views/dogbreeds/list/index.php';
    	require 'application/views/_templates/footer.php';  
    }
    
    public function listaAlfa(){
    	 
    	$dogBreeds=$this->svc->selecciona(null, null, null, null, null, null, null, null, null, 0, 10000);
    	$amountOfDogBreeds=$this->svc->seleccionaCuenta(null, null, null, null, null, null, null, null, null);
    	 
    	//     	echo "letra inicial=" . $letraInicial . " start=" . $start . " nombreOParte" . " selDogSize=" . $selDogSize . " selDogFeeding=" . $selDogFeeding .  " <br/>";
    	//     	echo "hayAnterior=" . $_REQUEST['hayAnterior'] . " haySiguiente=" . $_REQUEST['haySiguiente'] .   " amountOfDogBreeds=" . $amountOfDogBreeds .  " <br/>";
    
    	//create a map with initials=>array of breeds
    	$mapLetras=array();
    	foreach ($dogBreeds as $breed){
    		$initial= substr(ucfirst($breed->getNombre()), 0, 1);
    		if (!isset($mapLetras[$initial])){
    			$mapLetras[$initial]=array();
    		}
    		$mapLetras[$initial][]=$breed;
    	}
    	
    	$arrayLetras=array_keys($mapLetras);
    	
    	require 'application/views/dogbreeds/alphaList/header.php';
    	require 'application/views/dogbreeds/alphaList/index.php';
    	require 'application/views/_templates/footer.php';
    }
    
    


    

    
    
     
 
     public function info($nombreCodificado){
     	$info=$this->svc->obtienePorNombreCodificado($nombreCodificado);
     
     	$feedingArmado=DogBreedUtils::armaFeeding($info);
     	 
     	$shelters=$this->svc->selSheltersPorRaza($info->getId());
     	
     	$forums=$this->svcForums->selForumsByBreed($info->getId());
     
     	// load views. within the views we can echo out $songs and $amount_of_songs easily
     	require 'application/views/dogbreeds/details/headerDogBreedDetail.php';
     	require 'application/views/dogbreeds/details/index.php';
     	require 'application/views/_templates/footer.php';
     }
     

     
    
    
    

}
