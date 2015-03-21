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

require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/Resources.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/RequestUtils.php';





// header("Content-Type: text/plain; charset=utf-8");

class Shelters extends Controller{

	private static $tamPagina = 12;
	
    public function countries(){
    	
    	//pupulate the amount of shelters per country
    	$shelterCount=Resources::get("shelter_count_per_country");
    	if (empty($shelterCount)){
    	  $svc = new SheltersUsaSvcImpl(); $shelterCount["usa"]=$svc->selTodosCuenta(null, null, null, null, null, null, null);
    	  $svc = new SheltersCanadaSvcImpl(); $shelterCount["canada"]=$svc->selTodosCuenta(null, null, null, null, null, null, null);
    	  $svc = new SheltersUkSvcImpl(); $shelterCount["uk"]=$svc->selTodosCuenta(null, null, null, null, null, null, null);
    	  $svc = new SheltersJapanSvcImpl(); $shelterCount["japan"]=$svc->selTodosCuenta(null, null, null, null, null, null, null);
    	  $svc = new SheltersChinaSvcImpl(); $shelterCount["china"]=$svc->selTodosCuenta(null, null, null, null, null, null, null);
    	  $svc = new SheltersIndiaSvcImpl(); $shelterCount["india"]=$svc->selTodosCuenta(null, null, null, null, null, null, null);
    	  Resources::set("shelter_count_per_country", $shelterCount);
    	}
    	require 'application/views/shelters/header.php';
    	require 'application/views/shelters/countries.php';
    	require 'application/views/_templates/footer.php';
    }
    
    public function regionalList($country){
    	$_REQUEST["country"]=$country;
    	$ctrl=null;
    	switch ($country){
    		case "usa":
    			$headerTitleKey = "shelters_in_usa_title";
    			$headerTextKey = "shelters_in_usa_content";
    			$metaDescriptionKey = "meta_description_shelters_usa";
    			$metaKeywordsKey = "meta_keywords_shelters_usa";
    			break;
    		case "uk":
    			$headerTitleKey = "shelters_in_uk_title";
    			$headerTextKey = "shelters_in_uk_content";
    			$metaDescriptionKey = "meta_description_shelters_uk";
    			$metaKeywordsKey = "meta_keywords_shelters_uk";    			
    			break;
    		case "china":
    			$headerTitleKey = "shelters_in_china_title";
    			$headerTextKey = "shelters_in_china_content";
    			$metaDescriptionKey = "meta_description_shelters_china";
    			$metaKeywordsKey = "meta_keywords_shelters_china";
    			break;
    		case "japan":
    			$headerTitleKey = "shelters_in_japan_title";
    			$headerTextKey = "shelters_in_japan_content";
    			$metaDescriptionKey = "meta_description_shelters_japan";
    			$metaKeywordsKey = "meta_keywords_shelters_japan";
    			break;
    		case "canada":
    			$headerTitleKey = "shelters_in_canada_title";
    			$headerTextKey = "shelters_in_canada_content";
    			$metaDescriptionKey = "meta_description_shelters_canada";
    			$metaKeywordsKey = "meta_keywords_shelters_canada";
    			break;
    		case "india":
    			$headerTitleKey = "shelters_in_india_title";
    			$headerTextKey = "shelters_in_india_content";
    			$metaDescriptionKey = "meta_description_shelters_india";
    			$metaKeywordsKey = "meta_keywords_shelters_india";
    			break;
    	}
        require 'application/views/shelters/regionallist/header.php';
    	require 'application/views/shelters/regionallist/index.php';
    	require 'application/views/_templates/footer.php';
    }
    	 
        
    
    
    public function search($country){
        
    	$ctrl=null;
    	switch ($country){
    		case "usa":
    			$ctr=new SheltersList("usa",  "shelters_in_usa_title", "shelters_in_usa_content", "meta_description_shelters_usa", "meta_keywords_shelters_usa", 
    			 "mi", 0.621371192, new SheltersUsaSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    		case "uk":
    			$ctr=new SheltersList("uk", "shelters_in_uk_title", "shelters_in_uk_content",  "meta_description_shelters_uk", "meta_keywords_shelters_uk", 
    			"km", 1, new SheltersUkSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    		case "china":
    			$ctr=new SheltersList("china", "shelters_in_china_title", "shelters_in_china_content", "meta_description_shelters_china", "meta_keywords_shelters_china", 
    			"km", 1, new SheltersChinaSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    		case "japan":
    			$ctr=new SheltersList("japan", "shelters_in_japan_title", "shelters_in_japan_content", "meta_description_shelters_japan", "meta_keywords_shelters_japan", 
    			"km", 1, new SheltersJapanSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    		case "canada":
    			$ctr=new SheltersList("canada", "shelters_in_canada_title", "shelters_in_canada_content", "meta_description_shelters_canada", "meta_keywords_shelters_canada", 
    			"km", 1, new SheltersCanadaSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    		case "india":
    			$ctr=new SheltersList("india", "shelters_in_india_title", "shelters_in_india_content", "meta_description_shelters_india", "meta_keywords_shelters_india", 
    			"km", 1, new SheltersIndiaSvcImpl(), new ZipsGenericoSvcImpl());
    			break;
    	}
    	
          $_REQUEST["ctrlParams"]= "'$country'";
    	  $ctr->iniciaAvanzada();
    	
    }
    
    public function sitemap2($country, $area1Value, $area2Value){
    
    	switch ($country){
    		case "usa":
    			$headerTitleKey =  "shelters_in_usa_title";
    			$headerTextKey =  "shelters_in_usa_content";
    			$metaDescriptionKey = "meta_description_shelters_usa";
    			$metaKeywordsKey = "meta_keywords_shelters_usa";
    			break;
    		case "uk":
    			$headerTitleKey =  "shelters_in_uk_title";
    			$headerTextKey =  "shelters_in_uka_content";
    			$metaDescriptionKey = "meta_description_shelters_uk";
    			$metaKeywordsKey = "meta_keywords_shelters_uk";
    			break;
    		case "japan":
    			$headerTitleKey =  "shelters_in_japan_title";
    			$headerTextKey =  "shelters_in_japan_content";
    			$metaDescriptionKey = "meta_description_shelters_japan";
    			$metaKeywordsKey = "meta_keywords_shelters_japan";
    			break;
    		case "canada":
    			$headerTitleKey =  "shelters_in_japan_title";
    			$headerTextKey =  "shelters_in_japan_content";
    			$metaDescriptionKey = "meta_description_shelters_japan";
    			$metaKeywordsKey = "meta_keywords_shelters_japan";
    			break;
    		case "india":
    			$headerTitleKey =  "shelters_in_india_title";
    			$headerTextKey =  "shelters_in_india_content";
    			$metaDescriptionKey = "meta_description_shelters_india";
    			$metaKeywordsKey = "meta_keywords_shelters_india";
    			break;
    		case "china":
    			$headerTitleKey =  "shelters_in_china_title";
    			$headerTextKey =  "shelters_in_china_content";
    			$metaDescriptionKey = "meta_description_shelters_china";
    			$metaKeywordsKey = "meta_keywords_shelters_china";
    			break;
    	}
    
    	 
    	 
    	if ($country!=null && $area1Value!=null && $area2Value!=null){
    		//     		$area1Value=urldecode($area1Value);
    		//     		$area2Value=urldecode($area2Value);
    		 
    		$initParams="'".  $country . "','" . $area1Value . "','" . $area2Value . "'";
    
    	}else if ($country!=null && $area1Value!=null){
    		$area1Value=urldecode($area1Value);
    		 
    		$initParams="'".  $country . "','" . $area1Value . "',null";
    	}else if ($country!=null){
    		$area1Value=urldecode($area1Value);
    		 
    		$initParams="'".  $country . "', null, null";
    	}
    
    	$_REQUEST["country"] = $country;
    
    	require 'application/views/shelters/sitemap/headerSitemapShelters.php';
    	require 'application/views/shelters/sitemap/indexSitemapShelters.php';
    	require 'application/views/_templates/footer.php';
    }   
    public function listing($country, $area1Value){
    	 
    	 switch ($country){
    	 	case "usa":
    	 		$headerTitleKey =  "shelters_in_usa_title";
    	 		$headerTextKey =  "shelters_in_usa_content";
    	 		$metaDescriptionKey = "meta_description_shelters_usa";
    	 		$metaKeywordsKey = "meta_keywords_shelters_usa";
    	 		break;
    	 	case "uk":
    	 		$headerTitleKey =  "shelters_in_uk_title";
    	 		$headerTextKey =  "shelters_in_uka_content";
    	 		$metaDescriptionKey = "meta_description_shelters_uk";
    	 		$metaKeywordsKey = "meta_keywords_shelters_uk";
    	 		break;
    	 	case "japan":
    	 		$headerTitleKey =  "shelters_in_japan_title";
    	 		$headerTextKey =  "shelters_in_japan_content";
    	 		$metaDescriptionKey = "meta_description_shelters_japan";
    	 		$metaKeywordsKey = "meta_keywords_shelters_japan";
    	 		break;
    	 	case "canada":
    	 		$headerTitleKey =  "shelters_in_japan_title";
    	 		$headerTextKey =  "shelters_in_japan_content";
    	 		$metaDescriptionKey = "meta_description_shelters_japan";
    	 		$metaKeywordsKey = "meta_keywords_shelters_japan";
    	 		break;
    	 	case "india":
    	 		$headerTitleKey =  "shelters_in_india_title";
    	 		$headerTextKey =  "shelters_in_india_content";
    	 		$metaDescriptionKey = "meta_description_shelters_india";
    	 		$metaKeywordsKey = "meta_keywords_shelters_india";
    	 		break;
    	 	case "china":
    	 		$headerTitleKey =  "shelters_in_china_title";
    	 		$headerTextKey =  "shelters_in_china_content";
    	 		$metaDescriptionKey = "meta_description_shelters_china";
    	 		$metaKeywordsKey = "meta_keywords_shelters_china";
    	 		break;    	 		
    	 }    	 
    	 
       	 
    	
    	if ($country!=null && $area1Value!=null ){
//     		$area1Value=urldecode($area1Value);
//     		$area2Value=urldecode($area2Value);
    	
	    	$initParams="'".  $country . "','" . $area1Value . "'";

 
    	 }else if ($country!=null){

    	
	    	$initParams="'".  $country . "', null";
    	 }
	    	
    	 $_REQUEST["country"] = $country;
    	 
    	 require 'application/views/shelters/sitemap/headerSitemapShelters.php';
    	 require 'application/views/shelters/sitemap/indexSitemapShelters.php';
    	 require 'application/views/_templates/footer.php';
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
