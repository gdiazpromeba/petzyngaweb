<?php

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/business/shelters/SheltersList.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/business/shelters/ShelterDetails.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/DogBreedsSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/ZipsGenericoSvcImpl.php';

require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/SheltersUsaSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/SheltersJapanSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/SheltersChinaSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/SheltersUkSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/SheltersCanadaSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/SheltersIndiaSvcImpl.php';





// header("Content-Type: text/plain; charset=utf-8");

class Shelters extends Controller{

	private static $tamPagina = 12;
	
    public function countries(){
    	require 'application/views/shelters/header.php';
    	require 'application/views/shelters/countries.php';
    	require 'application/views/_templates/footer.php';
    }
    
    
    public function listing($country, $direccion){
    	$ctrl=null;
    	switch ($country){
    		case "usa":
    			$ctr=new SheltersList("usa",  "dog_shelters_in_usa_title", "dog_shelters_in_usa_content", "mi", 0.621371192, new SheltersUsaSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    		case "uk":
    			$ctr=new SheltersList("uk", "dog_shelters_in_uk_title", "dog_shelters_in_uk_content",  "km", 1, new SheltersUkSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    		case "china":
    			$ctr=new SheltersList("china", "dog_shelters_in_china_title", "dog_shelters_in_china_content", "km", 1, new SheltersChinaSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    		case "japan":
    			$ctr=new SheltersList("japan", "dog_shelters_in_japan_title", "dog_shelters_in_japan_content", "km", 1, new SheltersJapanSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    		case "canada":
    			$ctr=new SheltersList("canada", "dog_shelters_in_canada_title", "dog_shelters_in_canada_content", "km", 1, new SheltersCanadaSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    		case "india":
    			$ctr=new SheltersList("india", "dog_shelters_in_india_title", "dog_shelters_in_india_content", "km", 1, new SheltersIndiaSvcImpl(), new ZipsGenericoSvcImpl());
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
    		case "canada":
    			$ctr=new ShelterDetails("canada", new SheltersCanadaSvcImpl(), new DogBreedsSvcImpl());
    			break;
    		case "india":
    			$ctr=new ShelterDetails("india", new SheltersIndiaSvcImpl(), new DogBreedsSvcImpl());
    			break;
    	}
    	$ctr->info($urlEncoded);
    }
    

}
