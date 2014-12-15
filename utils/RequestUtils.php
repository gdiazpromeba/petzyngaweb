<?php
  class RequestUtils{

  	/**
  	 * función utilitaria para para poblar los forms de navegación de las páginas de web
  	 */
  	 public static function getValue($paramName){
  		if (isset($_REQUEST[$paramName])){
  			return $_REQUEST[$paramName];
  		}else{
  			return "";
  		}
  	 }
  	 
     public static function notSetOrEmpty($paramName){
     	if (!isset($_REQUEST[$paramName])){
  			return true;
  		}else if (empty($_REQUEST[$paramName]) ){
  			return true;  			
  		}else{
  			return false;
  		}
  	 }
  	 
  }
?>