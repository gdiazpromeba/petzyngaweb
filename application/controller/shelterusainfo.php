<?php

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/beans/ShelterUsa.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/SheltersUsaSvcImpl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/DogBreedsSvcImpl.php';


// header("Content-Type: text/plain; charset=utf-8");


class ShelterUsaInfo extends Controller
{
	private $svc;
	private $svcBreeds;
	
	public function __construct(){
		$this->svc = new SheltersUsaSvcImpl();
		$this->svcBreeds = new DogBreedsSvcImpl();
	}
	
	
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */
    public function info($urlEncoded){
    	//bean principal
    	$info=$this->svc->obtienePorUrlEncoded($urlEncoded);
    	
    	//razas relacionadas
    	//son pares id-nombre nada más, los convierto a beans 
    	$idNombres = $this->svcBreeds->selNombresPorShelter($info->getId());
    	
    	echo "candidad de nombres " . count($idNombres) . "<br>";
    	
    	$dogBreeds = array();
    	foreach($idNombres as $item){
    		$bean = $this->svcBreeds->obtiene($item['id']);
    		$dogBreeds[]=$bean;
    	}

        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/shelterusainfo/headerShelterUsaInfo.php';
        require 'application/views/shelterusainfo/index.php';
        require 'application/views/_templates/footer.php';
    }
    


}
