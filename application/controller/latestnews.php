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
    	if (isset($_SESSION['start'])){
    		$start=$_SESSION['start'];
    	}
    	
    	 
   	    $news=$this->svc->selTodos(null, $start, self::$tamPagina);
    	$amountOfNews=$this->svc->selTodos(null, $start, self::$tamPagina);
    	
    	foreach ($news as $bean){
    		$this->trataBean($bean);
    	}
    	
    	
    	$_SESSION['hayAnterior']= $start > 0;
    	$_SESSION['haySiguiente'] =($amountOfNews > self::$tamPagina);
    	$_SESSION['start'] = $start;
    	$_SESSION['amountOfDogBreeds'] = $amountOfNews;
    	
//     	echo "letra inicial=" . $letraInicial . " start=" . $start . " nombreOParte" . " selDogSize=" . $selDogSize . " selDogFeeding=" . $selDogFeeding .  " <br/>";
//     	echo "appartments=" . $selAppartments . " kids=" . $selKids .   " upkeep=" . $selUpkeep .  " <br/>";
    	 
    	require 'application/views/_templates/header.php';
    	require 'application/views/news/index.php';
    	require 'application/views/_templates/footer.php';  
    }
    
    private function trataBean($bean){
    	$newsText = $bean->getNewsText();
    	 
    	$newsText= str_replace("img src='", "img src='" . $GLOBALS['dirAplicacion'] .  "/resources/images/news/",  $newsText);
    	 
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
    
    
    public function siguiente(){
    	session_start();    	
    	
    	$letraInicial  = $_SESSION['letraInicial'];
    	$nombreOParte = $_SESSION['nombreOParte'];
    	$selDogSize = $_SESSION['selDogSize'];
    	$selDogFeeding = $_SESSION['selDogFeeding'];
    	$selAppartments = $_SESSION['selAppartments'];
    	$selKids = $_SESSION['selKids'];
    	$selUpkeep = $_SESSION['selUpkeep'];
    	$startAnterior = $_SESSION['start'];
    	$start =  $startAnterior + self::$tamPagina;
    	$amountOfDogBreeds = $_SESSION['amountOfDogBreeds'];
    	 
    	
    	$arrTamaños= $this->calculaTamaños($selDogSize);
    	$tamañoDesde=$arrTamaños[0];
    	$tamañoHasta=$arrTamaños[1];
    	
    	$arrUpkeep= $this->calculaUpkeep($selUpkeep);
    	$upkeepDesde=$arrUpkeep[0];
    	$upkeepHasta=$arrUpkeep[1];
    	
    	$dogBreeds=$this->svc->selecciona($nombreOParte, $letraInicial, $tamañoDesde, $tamañoHasta, $selDogFeeding, $selAppartments, $selKids, $upkeepDesde, $upkeepHasta, $start, self::$tamPagina);

    	$_SESSION['hayAnterior']= true;
    	$_SESSION['haySiguiente'] =($amountOfDogBreeds> ($start + self::$tamPagina));
    	$_SESSION['start'] = $start;
    	
//     	    	echo "letra inicial=" . $letraInicial . " start=" . $start . " nombreOParte" . " selDogSize=" . $selDogSize . " selDogFeeding=" . $selDogFeeding .  " <br/>";
//     	    	echo "appartments=" . $selAppartments . " kids=" . $selKids .   " upkeep=" . $selUpkeep .  " <br/>";

    	require 'application/views/_templates/header.php';
    	require 'application/views/dogbreeds/index.php';
    	require 'application/views/_templates/footer.php';
    }
    
    public function anterior(){
    	session_start();
    	 
    	$letraInicial  = $_SESSION['letraInicial'];
    	$nombreOParte = $_SESSION['nombreOParte'];
    	$selDogSize = $_SESSION['selDogSize'];
    	$selDogFeeding = $_SESSION['selDogFeeding'];
    	$selAppartments = $_SESSION['selAppartments'];
    	$selKids = $_SESSION['selKids'];
    	$selUpkeep = $_SESSION['selUpkeep'];
    	$startAnterior = $_SESSION['start'];
    	$start =  $startAnterior - self::$tamPagina;
    
    	$arrTamaños= $this->calculaTamaños($selDogSize);
    	$tamañoDesde=$arrTamaños[0];
    	$tamañoHasta=$arrTamaños[1];
    	
    	$arrUpkeep= $this->calculaUpkeep($selUpkeep);
    	$upkeepDesde=$arrUpkeep[0];
    	$upkeepHasta=$arrUpkeep[1];
    	 
    	$dogBreeds=$this->svc->selecciona($nombreOParte, $letraInicial, $tamañoDesde, $tamañoHasta, $selDogFeeding, $selAppartments, $selKids, $upkeepDesde, $upkeepHasta, $start, self::$tamPagina);
    
    	$_SESSION['hayAnterior']= $start > 0;
    	$_SESSION['haySiguiente'] = true;
    	$_SESSION['start'] = $start;
    	
    	require 'application/views/_templates/header.php';
    	require 'application/views/dogbreeds/index.php';
    	require 'application/views/_templates/footer.php';
    
    }
    
    private function calculaTamaños($selDogSize){
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
    
    private function calculaUpkeep($selUpkeep){
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
     	require 'application/views/_templates/header.php';
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
