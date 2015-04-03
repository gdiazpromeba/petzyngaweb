<?php

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/beans/DogBreed.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/DogBreedsSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/PetForumsSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/FrontPageSvcImpl.php';

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
	
		$this->alphabeticalSearch();
	}
	
	
    public function advancedSearch(){
    	
 
    	
//     	echo "letra inicial=" . $letraInicial . " start=" . $start . " nombreOParte" . " selDogSize=" . $selDogSize . " selDogFeeding=" . $selDogFeeding .  " <br/>";
//     	echo "hayAnterior=" . $_REQUEST['hayAnterior'] . " haySiguiente=" . $_REQUEST['haySiguiente'] .   " amountOfDogBreeds=" . $amountOfDogBreeds .  " <br/>";
    	 
    	require 'application/views/dogbreeds/headerDogBreeds.php';
    	require 'application/views/dogbreeds/list/index.php';
    	require 'application/views/_templates/footer.php';  
    }
    
    public function alphabeticalSearch(){
    	 
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
    	
    	require 'application/views/dogbreeds/alphalist/headerAlpha.php';
    	require 'application/views/dogbreeds/alphalist/indexAlpha.php';
    	require 'application/views/_templates/footer.php';
    }
    
    public function groups($dogGroup, $breedNameEncoded){
       
    	if ($breedNameEncoded != null){
    		$initParams="'" . $dogGroup . "','" . $breedNameEncoded . "'";
    		$breedParam= "'" . $breedNameEncoded . "'";
    	}elseif ($dogGroup != null){
            $initParams="'" . $dogGroup . "'";		
    	}else{
    		$initParams="null";
    	}
    	 
    	require 'application/views/dogbreeds/groups/headerGroups.php';
    	require 'application/views/dogbreeds/groups/indexGroups.php';
    	require 'application/views/_templates/footer.php';
    }    
    
    public function details($nombreCodificado){
    
    	$svc = new FrontPageSvcImpl();
    	$bean = $svc->obtiene();
    
    	$initParams = "'detalleRaza', '" . $nombreCodificado  . "'";
    
    
    	require 'application/views/home/header.php';
    	require 'application/views/home/index.php';
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
