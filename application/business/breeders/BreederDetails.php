<?php

class BreederDetails {
	private $svc;
	private $svcBreeds;
	private $countryUrl;
	
	public function __construct($countryUrl, $svc, $svcBreeds){
		$this->countryUrl = $countryUrl;
		$this->svc = $svc;
		$this->svcBreeds = $svcBreeds;
	}
	
	
    public function info($urlEncoded){
    	//bean principal
    	$info=$this->svc->obtienePorUrlEncoded($urlEncoded);
    	
    	//razas relacionadas
    	//son pares id-nombre nada más, los convierto a beans 
    	
    	$idNombres = $this->svcBreeds->selNombresPorBreeder($info->getId());
    	
    	$dogBreeds = array();
    	foreach($idNombres as $item){
    		$bean = $this->svcBreeds->obtiene($item['id']);
    		$dogBreeds[]=$bean;
    	}

        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/breeders/details/headerBreederDetails.php';
        $countryUrl = $this->countryUrl;
        require 'application/views/breeders/details/index.php';
        require 'application/views/_templates/footer.php';
    }
    


}
