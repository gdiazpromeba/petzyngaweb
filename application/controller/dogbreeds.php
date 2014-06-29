<?php

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/beans/DogBreed.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/DogBreedsSvcImpl.php';
// header("Content-Type: text/plain; charset=utf-8");

/**
 * Class Songs
 * This is a demo class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class DogBreeds extends Controller{
	private $svc;
	private static $tamPagina = 12;
	
	public function __construct(){
		$this->svc = new DogBreedsSvcImpl();
	}
	
	
    /**
     * PAGE: index
     * This method handles what happens when you move to http://dogbreeds
     * Puede ser al principio de todo, o cuando se vuelve de un ítem en particular
     */
    public function index(){
    	session_start();
    	
    	//letra inicial
    	$letraInicial=null;
    	$letraInicialPost=null;
    	$letraInicialSesion=null;
    	
    	
    	if (isset($_POST['letraInicial'])){
    		$letraInicialPost=$_POST['letraInicial'];
    		session_unset();
    	}
    	
    	if (isset($_SESSION['letraInicial'])){
    		$letraInicialSesion=$_SESSION['letraInicial'];
    	}
    	
    	
    	if (!is_null($letraInicialPost)){
    		$letraInicial=$letraInicialPost;
    	}else if (!empty($letraInicialSesion)){
    		$letraInicial=$letraInicialSesion;
    	}
    	 
    	
    	//nombreOParte
    	$nombreOParte=null;
    	$nombreOPartePost=null;
    	$nombreOParteSesion=null;
    	 
    	if (isset($_POST['nombreOParte'])){
    		$nombreOPartePost=$_POST['nombreOParte'];
    		session_unset();
    	}
    	 
    	if (isset($_SESSION['nombreOParte'])){
    		$nombreOParteSesion=$_SESSION['nombreOParte'];
    	}
    	 
    	//si el nombreOParte cambió, la sesión debe reiniciarse
    	if (!is_null($nombreOPartePost)  && $nombreOPartePost!=$nombreOParteSesion){
    		session_unset();
    	}
    	
    	if (!is_null($nombreOPartePost)){
    		$nombreOParte=$nombreOPartePost;
    	}else if (!empty($nombreOParteSesion)){
    		$nombreOParte=$nombreOParteSesion;
    	}    	
   	
    	
    	//selDogSize
    	$selDogSizePost=null;
    	$selDogSizeSesion=null;
    	$selDogSize=null;
    	
    	
    	if (isset($_POST['selDogSize'])){
    		$selDogSizePost=$_POST['selDogSize'];
    		session_unset();
    	}
    	
    	if (isset($_SESSION['selDogSize'])){
    		$selDogSizeSesion=$_SESSION['selDogSize'];
    	}
    	    	
    	
    	//si el selDogSize cambió, la sesión debe reiniciarse
    	if (!is_null($selDogSizePost)  && $selDogSizePost!=$selDogSizeSesion){
    		session_unset();
    	}    

    	if (!is_null($selDogSizePost)){
    		$selDogSize=$selDogSizePost;
    	}else if (!empty($selDogSizeSesion)){
    		$selDogSize=$selDogSizeSesion;
    	}
    	
    	$arrTamaños= $this->calculaTamaños($selDogSize);
    	$tamañoDesde=$arrTamaños[0];
    	$tamañoHasta=$arrTamaños[1];
    	
     
        //selDogFeeding
        $selDogFeeding=null;
        $selDogFeedingPost=null;
        $selDogFeedingSesion=null;
        
        if (isset($_POST['selDogFeeding'])){
        	$selDogFeedingPost=$_POST['selDogFeeding'];
        	session_unset();
        }
        
        if (isset($_SESSION['selDogFeeding'])){
        	$selDogFeedingSesion=$_SESSION['selDogFeeding'];
        }
        
        //si el selDogFeeding cambió, la sesión debe reiniciarse
        if (!is_null($selDogFeedingPost)  && $selDogFeedingPost!=$selDogFeedingSesion){
        	session_unset();
        }
         
        if (!is_null($selDogFeedingPost)){
        	$selDogFeeding=$selDogFeedingPost;
        }else if (!empty($selDogFeedingSesion)){
        	$selDogFeeding=$selDogFeedingSesion;
        }        
    	
    	$start=0;
    	if (isset($_SESSION['start'])){
    		$start=$_SESSION['start'];
    	}
    	
    	//selAppartments
    	$selAppartments=null;
    	$selAppartmentsPost=null;
    	$selAppartmentsSesion=null;
    	 
    	 
    	if (isset($_POST['selAppartments'])){
    		$selAppartmentsPost=$_POST['selAppartments'];
    		session_unset();
    	}
    	 
    	if (isset($_SESSION['selAppartments'])){
    		$selAppartmentsSesion=$_SESSION['selAppartments'];
    	}
    	
    	 
    	//si el selAppartments cambió, la sesión debe reiniciarse
    	if (!is_null($selAppartmentsPost)  && $selAppartmentsPost!=$selAppartmentsSesion){
    		session_unset();
    	}
    	
    	if (!is_null($selAppartmentsPost)){
    		$selAppartments=$selAppartmentsPost;
    	}else if (!empty($selDogSizeSesion)){
    		$selAppartments=$selAppartmentsSesion;
    	}  

    	//selKids
    	$selKids=null;
    	$selKidsPost=null;
    	$selKidsSesion=null;
    	
    	
    	if (isset($_POST['selKids'])){
    		$selKidsPost=$_POST['selKids'];
    		session_unset();
    	}
    	
    	if (isset($_SESSION['selKids'])){
    		$selKidsSesion=$_SESSION['selKids'];
    	}
    	 
    	 
    	if (!is_null($selKidsPost)){
    		$selKids=$selKidsPost;
    	}else if (!empty($selKidsSesion)){
    		$selKids=$selKidsSesion;
    	}    	
    	
    	//selUpkeep
    	$selUpkeep=null;
    	$selUpkeepPost=null;
    	$selUpkeepSesion=null;
    	 
    	 
    	if (isset($_POST['selUpkeep'])){
    		$selUpkeepPost=$_POST['selUpkeep'];
    		session_unset();
    	}
    	 
    	if (isset($_SESSION['selUpkeep'])){
    		$selUpkeepSesion=$_SESSION['selUpkeep'];
    	}
    	
    	
    	if (!is_null($selUpkeepPost)){
    		$selUpkeep=$selUpkeepPost;
    	}else if (!empty($selUpkeepSesion)){
    		$selUpkeep=$selUpkeepSesion;
    	} 

    	$arrUpkeep= $this->calculaUpkeep($selUpkeep);
    	$upkeepDesde=$arrUpkeep[0];
    	$upkeepHasta=$arrUpkeep[1];
    	
    	 
   	    $dogBreeds=$this->svc->selecciona($nombreOParte, $letraInicial, $tamañoDesde, $tamañoHasta, $selDogFeeding, $selAppartments, $selKids, $upkeepDesde, $upkeepHasta, $start, self::$tamPagina);
    	$amountOfDogBreeds=$this->svc->seleccionaCuenta($nombreOParte, $letraInicial, $tamañoDesde, $tamañoHasta, $selDogFeeding, $selAppartments, $selKids, $upkeepDesde, $upkeepHasta);
    	
    	$_SESSION['letraInicial']=$letraInicial;
    	$_SESSION['nombreOParte']=$nombreOParte;
    	$_SESSION['selDogSize']=$selDogSize;
    	$_SESSION['selDogFeeding']=$selDogFeeding;
    	$_SESSION['selAppartments']=$selAppartments;
    	$_SESSION['selKids']=$selKids;
    	$_SESSION['selUpkeep']=$selUpkeep;
    	$_SESSION['hayAnterior']= $start > 0;
    	$_SESSION['haySiguiente'] =($amountOfDogBreeds> self::$tamPagina);
    	$_SESSION['start'] = $start;
    	$_SESSION['amountOfDogBreeds'] = $amountOfDogBreeds;
    	
//     	echo "letra inicial=" . $letraInicial . " start=" . $start . " nombreOParte" . " selDogSize=" . $selDogSize . " selDogFeeding=" . $selDogFeeding .  " <br/>";
//     	echo "appartments=" . $selAppartments . " kids=" . $selKids .   " upkeep=" . $selUpkeep .  " <br/>";
    	 
    	require 'application/views/_templates/header.php';
    	require 'application/views/dogbreeds/index.php';
    	require 'application/views/_templates/footer.php';  
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
    
    

}
