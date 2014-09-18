<?php
  class NewsUtils{

  	
  	/**
  	* devuelve las primeras "posicionPalabra" palabras de un texto de estilo HTML
  	*/
  	public static function cortaPorPalabra($texto, $posicionPalabra){
  		$wcArr=str_word_count($texto,1, "><=.,;'ö\"_");
  		$lastKey=null;
  		$charIndex=0;
  		foreach (array_keys($wcArr) as $key){
  			$charIndex += strlen($wcArr[$key]) + 1;
  			if ($key >= $posicionPalabra){
  				$lastKey=$key;
  				break;
  			}
  		}
  		if ($lastKey!=null){
  			$texto = substr($texto, 0, $charIndex);
  		}
  		return $texto;
  	}
  	
  	/**
  	 *  le intercala el directorio que corresponde a la src de las imágenes que encuentre en el texto de la noticia
  	 */
  	public static function reemplazoImagenes($bean, $dirAplicacion){
  		$newsText = $bean->getNewsText();
  		$newsText= str_replace("img src='", "img src='" . $dirAplicacion .  "/resources/images/news/",  $newsText);
  		$bean->setNewsText($newsText);
  	}  	
  	
 
  }
?>