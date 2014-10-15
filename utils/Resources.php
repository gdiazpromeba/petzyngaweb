<?php
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/TextResourcesSvcImpl.php';

  class Resources{
  	
   private static $DIA = 86400;
  	 
   private static function getTextWithoutParameters($key){
       $res=__c()->get($key); 
  	   if ($res==null){
  	 		$svc = new TextResourcesSvcImpl();
  	 		$bean = $svc->obtienePorKey($key);
  	 		__c()->set($key, $bean->getText(), Resources::$DIA);
  	 		$res = $bean->getText();
  	 	}
  	 	return $res;
    }  	

    public static function purge(){
      __c()->clean();
      echo "caché cleaned!";
    }
    
    /*
     * same as getKey, but with parameter replacements.  "blah blah {1} blah"
    */
    public static function getText(){
    	$args=func_get_args();
    	$res = Resources::getTextWithoutParameters($args[0]);
    	if (count($args>1)){
    	  for ($i=1; $i< func_num_args(); $i++){
    		$token="{". $i . "}";
    		$res = str_replace($token, func_get_arg($i),  $res);
    	  }
    	}
    	return $res;
    }
    
    /*
     * almacena cualquier cosa en el caché, especialmente objetos
    */
    public static function set($key, $object){
//       echo "*******************************************************<br/>";
//       echo "before" . var_dump($cache); 
      __c()->set($key, $object, Resources::$DIA);
//       echo "*******************************************************<br/>";
//       echo "after" . var_dump($cache); 
    }
    
    /*
     * obtiene cualquier cosa del caché, si está. De lo cotrario devuelve null
    */
    public static function get($key){
//       if ( __c()->isExisting($key)){
        return __c()->get($key);
//       }else{
//       	return null;
//       }
    }
    
    /*
     * Obtiene un array de teasers, y de él un elemento al azar
    */
    public static function getTeasers($key){
       $arr=__c()->get($key); 
  	   if ($arr==null){
  	 		$svc = new TextResourcesSvcImpl();
  	 		$arr = $svc->selTeasers($key);
  	 		__c()->set($key, $arr, Resources::$DIA);
  	 	}
  	 	$index=rand(0, count($arr)-1);
  	 	$arrIndexed=array_values($arr);
  	 	$bean = $arrIndexed[$index];
  	 	$result =  $bean->getText();
  	 	return $result;
    }     
    
    
    
    
    
	 
  }
?>