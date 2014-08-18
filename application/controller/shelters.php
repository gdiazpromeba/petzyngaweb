<?php

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/business/SheltersList.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/business/ShelterDetails.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/DogBreedsSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/ZipsGenericoSvcImpl.php';

require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/SheltersUsaSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/SheltersJapanSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/SheltersChinaSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/SheltersUkSvcImpl.php';





// header("Content-Type: text/plain; charset=utf-8");

class Shelters extends Controller{

	private static $tamPagina = 12;
	
    public function countries(){
    	require 'application/views/_templates/header.php';
    	require 'application/views/shelters/countries.php';
    	require 'application/views/_templates/footer.php';
    }
    
    
    public function listing($country, $direccion){
    	$ctrl=null;
    	switch ($country){
    		case "usa":
    			$ctr=new SheltersList("usa", "mi", 0.621371192, new SheltersUsaSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    		case "uk":
    			$ctr=new SheltersList("uk", "km", 1, new SheltersUkSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    		case "china":
    			$ctr=new SheltersList("china", "km", 1, new SheltersChinaSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    		case "japan":
    			$ctr=new SheltersList("japan", "km", 1, new SheltersJapanSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    	}
    	
    	if ($direccion=="previous"){
    	  $ctr->anterior();
    	}else if ($direccion=="next"){
    	  $ctr->siguiente();
    	}else if ($direccion=="list"){
    	  	$ctr->lista();    	  
    	}else{
    	  $ctr->inicia();
    	}
    }
    
    public function info($country, $urlEncoded){
    	$ctrl=null;
    	switch ($country){
    		case "usa":
    			$ctr=new ShelterDetails("usa", new SheltersUsaSvcImpl(), new DogBreedsSvcImpl());
    			break;
    		case "uk":
    			$ctr=new ShelterDetails("uk", new SheltersUkSvcImpl(), new DogBreedsSvcImpl());
    			break;
    		case "china":
    			$ctr=new ShelterDetails("china", new SheltersChinaSvcImpl(), new DogBreedsSvcImpl());
    			break;
    		case "japan":
    			$ctr=new ShelterDetails("japan", new SheltersJapanSvcImpl(), new DogBreedsSvcImpl());
    			break;
    	}
    	$ctr->info($urlEncoded);
    }
    

}
