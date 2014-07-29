<?php

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/beans/ShelterUsa.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/SheltersUsaSvcImpl.php';
// header("Content-Type: text/plain; charset=utf-8");


class ShelterUsaInfo extends Controller
{
	private $svc;
	
	public function __construct(){
		$this->svc = new SheltersUsaSvcImpl();
	}
	
	
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */
    public function info($urlEncoded)
    {
    	$info=$this->svc->obtienePorUrlEncoded($urlEncoded);
    		
    	//$feedingArmado=$this->armaFeeding($info);

        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/shelterusainfo/headerShelterUsaInfo.php';
        require 'application/views/shelterusainfo/index.php';
        require 'application/views/_templates/footer.php';
    }
    


}
