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
    	
    	$this->trataBean($bean, "1");
    	$this->trataBean($bean, "2");
    	
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/home/header.php';
        require 'application/views/home/index.php';
        require 'application/views/_templates/footer.php';
    }
    
    private function trataBean($bean, $indice){
    	$method = "getNews" . $indice . "Text";
    	$newsText = $bean->$method();
    	
    	$newsText= str_replace("img src='", "img src='" . $GLOBALS['dirAplicacion'] .  "/resources/images/news/",  $newsText);
    	
    	$method =  "getNews" . $indice . "Cut";
        $cutPos = $bean->$method();
        
        $wcArr=str_word_count($newsText,1, "><=.,;'ö\"_");
        
        $lastKey=null;
        $charIndex=0;
        foreach (array_keys($wcArr) as $key){
        	$charIndex += strlen($wcArr[$key]) + 1;
        	if ($key >= $cutPos){
        		$lastKey=$key;
        		break;
        	}
        }
         
        if ($lastKey!=null){
        	$newsText = substr($newsText, 0, $charIndex);
        }
        
        $method = "setNews" . $indice . "Text";
        $newsText = $bean->$method($newsText);
        
        
    }


}
