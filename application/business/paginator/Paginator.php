<?php
/**
 * clase que construye la serie de links de paginaci�n
 * @author Gonzalo
 *
 */
class Paginator {
	/**
	 * nombre del par�metro que indica el punto de comienzo
	 * @var unknown
	 */
	private $startParameter;
	
	/**
	 * la url base de los links
	 * @var unknown
	 */
	private $baseUrl;
	
	/**
	 * la cantidad de elementos que hay
	 * @var unknown
	 */
	private $count;
	
	/**
	 * el tama�o de p�gina (en cantidad de elementos)
	 * @var unknown
	 */
	private $pageSize;
	
	/**
	 * la cantidad m�xima de links a p�gina que quiero mostrar el esta serie. Si los elementos son m�s que la cantidad m�xima, 
	 * hay que idear algo para abreviarla por el medio (...)
	 * @var unknown
	 */
	private $pagesShown;

	public function __construct($startParameter, $baseUrl, $count, $pageSize, $pagesShown){
		$this->startParameter = $startParameter;
		$this->baseUrl = $baseUrl;
		$this->count = $count;
		$this->pageSize = $pageSize;
	}
	
	public function getVinculos(){
		$div=$this->count/$this->pageSize;
		$segments=floor($div);
		if ($div>$segments){
			$segments++;
		}
		$vinculos=array();
		
		for ($i=0; $i<$segments; $i++){
			$vinculo = $this->buildLink($segNum);
			$vinculos[$vinculo]=$segnum;
		}
		return $vinculos;
	}
	
	private function buildLink($segNum){
		$res=$baseUrl . "?" . $this->startParameter . "=" . ($segNum * $this->pageSize);
	}

}