<?php


require_once 'config.php';

require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirAplicacion'] . '/svc/impl/PetForumsSvcImpl.php';

require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/Resources.php';





// header("Content-Type: text/plain; charset=utf-8");

class Forums extends Controller{

	private $svc;
	

    public function info($encodedName){
    	$this->svc=new PetForumsSvcImpl();
    	$info=$this->svc->obtiene($encodedName);
    	require 'application/views/forums/details/headerForumDetails.php';
    	require 'application/views/forums/details/index.php';
    	require 'application/views/_templates/footer.php';
    }
    

}
