<?php
include("utils/phpfastcache/phpfastcache.php");
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/TextResourcesSvcImpl.php';

  class Resources{
  	
   private static $cache;

  	 
   public static function getText($key){
       if (empty(Resources::$cache)){
         phpFastCache::setup("storage","files");
         phpFastCache::setup("path", $GLOBALS['pathWeb']);       	
       	 Resources::$cache=phpFastCache();
       }
       $res = Resources::$cache->get($key); 
  	   if ($res==null){
  	 		$svc = new TextResourcesSvcImpl();
  	 		$bean = $svc->obtienePorKey($key);
  	 		Resources::$cache->set($key, $bean->getText(), 120);
  	 		$res = $bean->getText();
  	 	}
  	 	return $res;
    }  	

    public static function purge(){
      if (!empty(Resources::$cache)){
    	Resources::$cache->clean();
    	echo "nothing cached at the moment!";
      }
      echo "caché cleaned!";
    }
	 
  }
?>