<?php
  class UrlUtils{

  	/**
  	 * funci�n utilitaria para para poblar los forms de navegaci�n de las p�ginas de web
  	 */
  	 public static function codifica($url){
  	 	$url =  str_replace(" ", "-", $url);
  		return $url;
  	 }
  	 
     public static function decodifica($url){
  	 	$url =  str_replace("-", " ", $url);
  		return $url;
  	 }
  	 
  	 
  }
?>