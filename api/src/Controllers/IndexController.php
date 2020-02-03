<?php
namespace PropelORMAPI\Controllers;

use PropelORMAPI\Services\VOS\IndexVO;

class IndexController 
{
	private $c;
	private $logger;

  public function __construct($c)
  {
	  $this->c = $c;
    $this->logger = $c->get('logger');  
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");		
	}

	public function saludar($request, $response, $args)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");
    $vo = new IndexVO();
		$respuesta = $this->c->IndexService->saludar($vo);
    $response->getBody()->write($respuesta);
    return $response;
	}	

	function __destruct() {
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");      
	}

}
?>