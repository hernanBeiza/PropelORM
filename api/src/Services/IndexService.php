<?php
namespace PropelORMAPI\Services;


class IndexService 
{
	private $c;
	private $logger;

  public function __construct($c)
  {
    $this->c = $c;
    $this->logger = $c->get('logger');  
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");		
	}

	public function saludar()
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");		
  	$respuesta = $this->c->IndexDAO->saludar();
    return $respuesta;
	}
	
	function __destruct() {
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");      
	}

}
?>