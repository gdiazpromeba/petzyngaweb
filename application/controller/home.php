<?php
require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/FrontPageSvcImpl.php';

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index(){
    	
    	$svc = new FrontPageSvcImpl();
    	$bean = $svc->obtiene();
    	

        $initParams = "'contenido', null";

    	
       
        require 'application/views/home/header.php';
        require 'application/views/home/index.php';
        require 'application/views/_templates/footer.php';
    }
    
    public function breed($nombreCodificado){
    	 
    	$svc = new FrontPageSvcImpl();
    	$bean = $svc->obtiene();
    	 
    	$initParams = "'detalleRaza', '" . $nombreCodificado  . "'";
    	 
    	 
    	require 'application/views/home/header.php';
    	require 'application/views/home/index.php';
    	require 'application/views/_templates/footer.php';
    }    
    

}
