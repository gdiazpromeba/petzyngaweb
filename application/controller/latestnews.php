<?php

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/NewsSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/business/news/NewsUtils.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/RequestUtils.php';



class LatestNews extends Controller{
	private $svc;
	private static $tamPagina = 3;
	
	public function __construct(){
		$this->svc = new NewsSvcImpl();
	}
	
	public function index(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$_REQUEST['start']=0;
	
		$this->lista();
	}	
	
	private function lista(){
		 
		if (RequestUtils::notSetOrEmpty('start')){
			$_REQUEST['start']=0;
		}
		$start=$_REQUEST['start'];
	
	
		$news=$this->svc->selTodos(null, $start, self::$tamPagina);
		$amountOfNews=$this->svc->selTodosCuenta(null);
		 
		foreach ($news as $bean){
			$this->trataBean($bean);
		}
		 
		$_REQUEST['hayAnterior']= ($_REQUEST['start']  > 0);
		$_REQUEST['haySiguiente'] =($amountOfNews > ($_REQUEST['start'] + self::$tamPagina));
		 
		 
		//     	echo "amountOfNews=" . $amountOfNews . "  start = " . $start . " tampagina= " . self::$tamPagina . "\n";
		 
		require 'application/views/news/header.php';
		require 'application/views/news/list/index.php';
		require 'application/views/_templates/footer.php';
	}	
	
	
    public function listing(){
        if (!RequestUtils::notSetOrEmpty('navegacion')){
    		$navegacion=$_REQUEST['navegacion'];
    		if ($navegacion=="siguiente"){
    			$this->siguiente();
    		}else if ($navegacion=="anterior"){
    			$this->anterior();
    		}
    	}else{
    	  $this->lista();
    	}	
    }
    
    private function trataBean($bean){

    	NewsUtils::reemplazoImagenes($bean, $GLOBALS['dirAplicacion']);
    	
    	$newsText = $bean->getNewsText();
    	$cutPos = $bean->getCutPosition();
    	
    	$newsText = NewsUtils::cortaPorPalabra($newsText, $cutPos);
    
    	$bean->setNewsText($newsText);
    }
    
    private function anterior(){
    	$_REQUEST['start'] = $_REQUEST['start'] - self::$tamPagina;
    	$this->lista();
    }
    
    private function siguiente(){
    	$_REQUEST['start']= $_REQUEST['start'] + self::$tamPagina;;
    	$this->lista();
    }    


    

     public function info($urlEncoded){
     	$bean=$this->svc->obtienePorUrlEncoded($urlEncoded);
     	
     	NewsUtils::reemplazoImagenes($bean, $GLOBALS['dirAplicacion']);
     	
     
     	// load views. within the views we can echo out $songs and $amount_of_songs easily
     	require 'application/views/_templates/header.php';
     	require 'application/views/news/details/index.php';
     	require 'application/views/_templates/footer.php';
     }
     
}
