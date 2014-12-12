<?php
  class UrlUtils{

  	/**
  	 * función utilitaria para para poblar los forms de navegación de las páginas de web
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