<?php

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/NewsSvcImpl.php';


class LatestNews extends Controller{
	private $svc;
	private static $tamPagina = 3;
	
	public function __construct(){
		$this->svc = new NewsSvcImpl();
	}
	
	
    public function index(){
    	session_start();
    	
    	$start=0;
    	if (isset($_SESSION['newsStart'])){
    		$start=$_SESSION['newsStart'];
    	}
    	
    	 
   	    $news=$this->svc->selTodos(null, $start, self::$tamPagina);
    	$amountOfNews=$this->svc->selTodosCuenta(null);
    	
    	foreach ($news as $bean){
    		$this->trataBean($bean);
    	}
    	
    	
    	$_SESSION['hayAnterior']= $start > 0;
    	$_SESSION['haySiguiente'] =($amountOfNews > self::$tamPagina);
    	$_SESSION['newsStart'] = $start;
    	$_SESSION['amountOfNews'] = $amountOfNews;
    	
//     	echo "amountOfNews=" . $amountOfNews . "  start = " . $start . " tampagina= " . self::$tamPagina . "\n";
    	
//     	echo "letra inicial=" . $letraInicial . " start=" . $start . " nombreOParte" . " selDogSize=" . $selDogSize . " selDogFeeding=" . $selDogFeeding .  " <br/>";
//     	echo "appartments=" . $selAppartments . " kids=" . $selKids .   " upkeep=" . $selUpkeep .  " <br/>";
    	 
    	require 'application/views/_templates/header.php';
    	require 'application/views/news/list/index.php';
    	require 'application/views/_templates/footer.php';  
    }
    
    private function trataBean($bean){

    	$this->reemplazoImagenes($bean);
    	
    	$newsText = $bean->getNewsText();
    	$cutPos = $bean->getCutPosition();
    
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
    
    	$bean->setNewsText($newsText);
    }

    /**
    *  dado un bean de News, le toma el texto de la noticia y le reemplaza la src de sus imágenes
    *  por el path apropiado
    */
    private function reemplazoImagenes($bean){
    	$newsText = $bean->getNewsText();
    	$newsText= str_replace("img src='", "img src='" . $GLOBALS['dirAplicacion'] .  "/resources/images/news/",  $newsText);
    	$bean->setNewsText($newsText);
    }
    
    
    public function siguiente(){
    	session_start();    	
    	
    	$startAnterior = $_SESSION['newsStart'];
    	$start =  $startAnterior + self::$tamPagina;
    	$amountOfNews = $_SESSION['amountOfNews'];
    	 
    	$news=$this->svc->selTodos(null, $start, self::$tamPagina);
    	
    	foreach ($news as $bean){
    		$this->trataBean($bean);
    	}
    	
    	
    	$_SESSION['hayAnterior']= true;
    	$_SESSION['haySiguiente'] =($amountOfNews> ($start + self::$tamPagina));
    	$_SESSION['newsStart'] = $start;
    	
        echo "amountOfNews=" . $amountOfNews . "  start = " . $start . " tampagina= " . self::$tamPagina . "\n";
    	require 'application/views/_templates/header.php';
    	require 'application/views/news/list/index.php';
    	require 'application/views/_templates/footer.php';
    }
    
    public function anterior(){
    	session_start();

    	$startAnterior = $_SESSION['newsStart'];
    	$start =  $startAnterior - self::$tamPagina;
    
    	$news=$this->svc->selTodos(null, $start, self::$tamPagina);
    	
    	foreach ($news as $bean){
    		$this->trataBean($bean);
    	}
    	    
    	$_SESSION['hayAnterior']= $start > 0;
    	$_SESSION['haySiguiente'] = true;
    	$_SESSION['newsStart'] = $start;
    	
    	require 'application/views/_templates/header.php';
    	require 'application/views/news/list/index.php';
    	require 'application/views/_templates/footer.php';
    
    }
    

     public function info($urlEncoded){
     	$bean=$this->svc->obtienePorUrlEncoded($urlEncoded);
     	
     	$this->reemplazoImagenes($bean);
     	
     
     	// load views. within the views we can echo out $songs and $amount_of_songs easily
     	require 'application/views/_templates/header.php';
     	require 'application/views/news/details/index.php';
     	require 'application/views/_templates/footer.php';
     }
     
}
