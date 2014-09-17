<?php
  class DogBreedUtils{

       /**
      * convierte el número decimal a una cadena con valor fraccionario
      * @param unknown $numero
      */
     public static function trataFracciones($numero){
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
     
     /**
      * toma los valores de serving Min y Max
      * @param unknown $info
      */
     public static function armaFeeding($info){
     	$min= $info->getServingMin();
     	$max= $info->getServingMax();
     	 
     	if ($min!=$max){
     		$res= DogBreedUtils::trataFracciones($min);
     		$res .=" to " . DogBreedUtils::trataFracciones($max);
     		$res .=" cups of quality dry food, twice a day";
     	}else{
     		$res= DogBreedUtils::trataFracciones($min);
     		$res .=" cups of quality dry food, twice a day";
     	}
     	return $res;
     } 

     public static function calculaUpkeep($selUpkeep){
     	$upkeepDesde=1;
     	$upkeepHasta=5;
     	switch($selUpkeep){
     		case "little":
     			$upkeepDesde=1;
     			$upkeepHasta=2;
     			break;
     		case "average":
     			$upkeepDesde=3;
     			$upkeepHasta=3;
     			break;
     		case "a lot":
     			$upkeepDesde=4;
     			$upkeepHasta=5;
     			break;
     	}
     	return array($upkeepDesde, $upkeepHasta);
     }    

     
     public static  function calculaTamaños($selDogSize){
     	$tamañoDesde=0;
     	$tamañoHasta=100;
     
     	switch($selDogSize){
     		case "large":
     			$tamañoDesde=60;
     			$tamañoHasta=60;
     			break;
     		case "medium":
     			$tamañoDesde=50;
     			$tamañoHasta=50;
     			break;
     		case "small":
     			$tamañoDesde=30;
     			$tamañoHasta=30;
     			break;
     		case "toy":
     			$tamañoDesde=20;
     			$tamañoHasta=20;
     			break;
     		default:
     			$tamañoDesde=0;
     			$tamañoHasta=100;
     			break;
     	}
     	return array($tamañoDesde, $tamañoHasta);
     
     }     
     
     
     
  }
?>