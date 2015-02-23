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
    	
    	//pupulate the amount of breeders per country
    	$breederCount=Resources::get("breeder_count_per_country");
    	if (empty($breederCount)){
    	  $svc = new BreedersUsaSvcImpl(); $breederCount["usa"]=$svc->selTodosCuenta(null, null, null, null, null, null, null);
    	  $svc = new BreedersCanadaSvcImpl(); $breederCount["canada"]=$svc->selTodosCuenta(null, null, null, null, null, null, null);
    	  $svc = new BreedersUkSvcImpl(); $breederCount["uk"]=$svc->selTodosCuenta(null, null, null, null, null, null, null);

    	  Resources::set("breeder_count_per_country", $breederCount);
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
    
    public function sitemap($country, $area1Value, $area2Value, $breed){
    
    	switch ($country){
    		case "usa":
    			$headerTitleKey =  "breeders_in_usa_title";
    			$headerTextKey =  "breeders_in_usa_content";
    			$metaDescriptionKey = "meta_description_breeders_usa";
    			$metaKeywordsKey = "meta_keywords_breeders_usa";
    			break;
    		case "uk":
    			$headerTitleKey =  "breeders_in_uk_title";
    			$headerTextKey =  "breeders_in_uka_content";
    			$metaDescriptionKey = "meta_description_breeders_uk";
    			$metaKeywordsKey = "meta_keywords_breeders_uk";
    			break;
    		case "japan":
    			$headerTitleKey =  "breeders_in_japan_title";
    			$headerTextKey =  "breeders_in_japan_content";
    			$metaDescriptionKey = "meta_description_breeders_japan";
    			$metaKeywordsKey = "meta_keywords_breeders_japan";
    			break;
    		case "canada":
    			$headerTitleKey =  "breeders_in_japan_title";
    			$headerTextKey =  "breeders_in_japan_content";
    			$metaDescriptionKey = "meta_description_breeders_japan";
    			$metaKeywordsKey = "meta_keywords_breeders_japan";
    			break;
    		case "india":
    			$headerTitleKey =  "breeders_in_india_title";
    			$headerTextKey =  "breeders_in_india_content";
    			$metaDescriptionKey = "meta_description_breeders_india";
    			$metaKeywordsKey = "meta_keywords_breeders_india";
    			break;
    		case "china":
    			$headerTitleKey =  "breeders_in_china_title";
    			$headerTextKey =  "breeders_in_china_content";
    			$metaDescriptionKey = "meta_description_breeders_china";
    			$metaKeywordsKey = "meta_keywords_breeders_china";
    			break;
    	}
    

    	if ($country!=null && $area1Value!=null && $area2Value!=null && $breed!= null ){
		 
    		$initParams="'".  $country . "','" . $area1Value . "','" . $area2Value . "','" . $breed . "'";
    	 
    	}elseif ($country!=null && $area1Value!=null && $area2Value!=null){
  		 
    		$initParams="'".  $country . "','" . $area1Value . "','" . $area2Value . "', null";
    
    	}else if ($country!=null && $area1Value!=null){
    		$area1Value=urldecode($area1Value);
    		 
    		$initParams="'".  $country . "','" . $area1Value . "',null, null";
    	}else if ($country!=null){
    		$area1Value=urldecode($area1Value);
    		 
    		$initParams="'".  $country . "', null, null, null";
    	}
    
    
    	require 'application/views/breeders/sitemap/headerSitemapBreeders.php';
    	require 'application/views/breeders/sitemap/indexSitemapBreeders.php';
    	require 'application/views/_templates/footer.php';
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
