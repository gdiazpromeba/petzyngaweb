<?php
  class RequestUtils{

  	/**
  	 * funci�n utilitaria para para poblar los forms de navegaci�n de las p�ginas de web
  	 */
  	 public static function getValue($paramName){
  		if (isset($_REQUEST[$paramName])){
  			return $_REQUEST[$paramName];
  		}else{
  			return "";
  		}
  	 }
  	 
     public static function notSetOrEmpty($paramName){
  		if (!isset($_REQUEST[$paramName])  || empty($_REQUEST[$paramName]) ){
  			true;
  		}else{
  			return false;
  		}
  	 }
  	 
  }
?>