<?php


require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/business/breeders/BreedersList.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/business/breeders/BreederDetails.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/DogBreedsSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/ZipsGenericoSvcImpl.php';

require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/BreedersUsaSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/BreedersCanadaSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/BreedersUkSvcImpl.php';

require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/Resources.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/RequestUtils.php';





// header("Content-Type: text/plain; charset=utf-8");

class Breeders extends Controller{

	private static $tamPagina = 12;
	
    public function countries(){
    	
    	//pupulate the amount of shelters per country
    	$breederCount=Resources::get("breeder_count_per_country");
    	if (empty($shelterCount)){
    	  $svc = new BreedersUsaSvcImpl(); $shelterCount["usa"]=$svc->selTodosCuenta(null, null, null, null, null, null, null);
    	  $svc = new BreedersCanadaSvcImpl(); $shelterCount["canada"]=$svc->selTodosCuenta(null, null, null, null, null, null, null);
    	  $svc = new BreedersUkSvcImpl(); $shelterCount["uk"]=$svc->selTodosCuenta(null, null, null, null, null, null, null);

    	  Resources::set("breeder_count_per_country", $shelterCount);
    	}
    	require 'application/views/breeders/header.php';
    	require 'application/views/breeders/countries.php';
    	require 'application/views/_templates/footer.php';
    }
    
    

    
    public function regionalList($country){
    	$_REQUEST["country"]=$country;
    	$ctrl=null;
    	switch ($country){
    		case "usa":
    			$headerTitleKey = "breeders_in_usa_title";
    			$headerTextKey = "breeders_in_usa_content";
    			$metaDescriptionKey = "meta_description_breeders_usa";
    			$metaKeywordsKey = "meta_keywords_breeders_usa";
    			break;
    		case "uk":
    			$headerTitleKey = "breeders_in_uk_title";
    			$headerTextKey = "breeders_in_uk_content";
    			$metaDescriptionKey = "meta_description_breeders_uk";
    			$metaKeywordsKey = "meta_keywords_breeders_uk";
    			break;

    		case "canada":
    			$headerTitleKey = "breeders_in_canada_title";
    			$headerTextKey = "breeders_in_canada_content";
    			$metaDescriptionKey = "meta_description_breeders_canada";
    			$metaKeywordsKey = "meta_keywords_breeders_canada";
    			break;

    	}
    	require 'application/views/breeders/regionallist/header.php';
    	require 'application/views/breeders/regionallist/index.php';
    	require 'application/views/_templates/footer.php';
    }    
    
    public function advancedList($country){
    	$ctrl=null;
    	switch ($country){
    		case "usa":
    			$ctr=new BreedersList("usa",  "breeders_in_usa_title", "breeders_in_usa_content", "meta_description_breeders_usa", "meta_keywords_breeders_usa",
    			"mi", 0.621371192, new BreedersUsaSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    		case "canada":
    			$ctr=new BreedersList("canada",  "breeders_in_canada_title", "breeders_in_canada_content", "meta_description_breeders_canada", "meta_keywords_breeders_canada",
    			"km", 1, new BreedersCanadaSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    		case "uk":
    			$ctr=new BreedersList("uk",  "breeders_in_uk_title", "breeders_in_uk_content", "meta_description_breeders_uk", "meta_keywords_breeders_uk",
    			"km", 1, new BreedersUkSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    				
    	}
    	$ctr->iniciaAvanzada();

    }    
    
    public function info($country, $urlEncoded){
    	$ctrl=null;
    	switch ($country){
    		case "usa":
    			$ctr=new BreederDetails("usa", new BreedersUsaSvcImpl(), new DogBreedsSvcImpl());
    			break;
    		case "canada":
    			$ctr=new BreederDetails("canada", new BreedersCanadaSvcImpl(), new DogBreedsSvcImpl());
    			break;
    		case "uk":
    			$ctr=new BreederDetails("uk", new BreedersUkSvcImpl(), new DogBreedsSvcImpl());
    			break;
    				 
    	}
    	$ctr->info($urlEncoded);
    }
    

}
