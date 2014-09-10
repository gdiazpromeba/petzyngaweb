<?php

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/beans/DogBreed.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/DogBreedsSvcImpl.php';
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
class DogBreedInfo extends Controller
{
	private $svc;
	
	public function __construct(){
		$this->svc = new DogBreedsSvcImpl();
	}
	
	
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */
    public function info($nombre)
    {
    	$nombre=str_replace("_", " ", $nombre);
    	$info=$this->svc->obtienePorNombre($nombre);
    		
    	$feedingArmado=$this->armaFeeding($info);
    	
    	$shelters=$this->svc->selSheltersPorRaza($info->getId());

        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/headerDogBreeds.php';
        require 'application/views/dogbreedinfo/index.php';
        require 'application/views/_templates/footer.php';
    }
    
    /**
     * toma los valores de serving Min y Max
     * @param unknown $info
     */
    private function armaFeeding($info){
      $min= $info->getServingMin();
      $max= $info->getServingMax();
      
      if ($min!=$max){
	      $res= $this->trataFracciones($min);
	      $res .=" to " . $this->trataFracciones($max);
	      $res .=" cups of quality dry food, twice a day";
      }else{
      	$res= $this->trataFracciones($min);
      	$res .=" cups of quality dry food, twice a day";
      }
      return $res;
    }
    
	/**
	 * convierte el n�mero decimal a una cadena con valor fraccionario
	 * @param unknown $numero
	 */
    private function trataFracciones($numero){
    	$intpart = floor( $numero ) ;  
    	$fraction = $numero - $intpart;
    	$fraccionStr="";
    	if ($fraction!=0){
	    	switch($fraction){
	    		case 0.5:
	    			$fraccionStr="½";
	    			break;
	    		case 0.25:
	    			$fraccionStr="¼";
	    			break;
	    		case 0.75:
	    			$fraccionStr="¾";
	    			break;
	    		default:
	    			$fraccionStr=(string)$fraction;
	    	}
    	}
    	
    	if ($intpart==0){
    		return $fraccionStr;
    	}else{
    		return (string)$intpart . $fraccionStr;
    	}
    }

}
