<?php


require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/business/breeders/BreedersList.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/business/breeders/BreederDetails.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/DogBreedsSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/ZipsGenericoSvcImpl.php';

require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/BreedersUsaSvcImpl.php';

require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/Resources.php';





// header("Content-Type: text/plain; charset=utf-8");

class Breeders extends Controller{

	private static $tamPagina = 12;
	
    public function countries(){
    	
    	//pupulate the amount of shelters per country
    	$breederCount=Resources::get("breeder_count_per_country");
    	if (empty($shelterCount)){
    	  $svc = new BreedersUsaSvcImpl(); $shelterCount["usa"]=$svc->selTodosCuenta(null, null, null, null, null, null, null);

    	  Resources::set("breeder_count_per_country", $shelterCount);
    	}
    	require 'application/views/breeders/header.php';
    	require 'application/views/breeders/countries.php';
    	require 'application/views/_templates/footer.php';
    }
    
    
    public function listing($country, $direccion){
    	$ctrl=null;
    	switch ($country){
    		case "usa":
    			$ctr=new BreedersList("usa",  "breeders_in_usa_title", "breeders_in_usa_content", "meta_description_breeders_usa", "meta_keywords_breeders_usa", 
    			 "mi", 0.621371192, new BreedersUsaSvcImpl(), new ZipsGenericoSvcImpl());
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
    			$ctr=new BreederDetails("usa", new BreedersUsaSvcImpl(), new DogBreedsSvcImpl());
    			break;
    	}
    	$ctr->info($urlEncoded);
    }
    

}
