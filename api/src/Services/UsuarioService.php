<?php
namespace PropelORMAPI\Services;

use PropelORMAPI\Services\VOS\UsuarioVO;

use PropelORMAPI\DAOS\Usuario;
use PropelORMAPI\DAOS\UsuarioQuery;

class UsuarioService 
{
	private $c;
	private $logger;

  public function __construct($c)
  {
    $this->c = $c;
    $this->logger = $c->get('logger');  
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");		
	}

	public function guardar($usuarioVO)
	{
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		$respuesta = $this->c->UsuarioDAO->guardar($usuarioVO);
    return $respuesta;
	}
	
	public function editar($usuarioVO)
	{
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		$respuesta = $this->c->UsuarioDAO->editar($usuarioVO);    
    return $respuesta;
	}
	
	public function eliminar($usuarioVO)
	{
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		$respuesta = $this->c->UsuarioDAO->eliminar($usuarioVO);
    return $respuesta;
	}

	public function obtener($pag)
	{
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");
		$respuesta = $this->c->UsuarioDAO->obtener($pag);
    return $respuesta;
	}

	public function obtenerConID($idUsuario)
	{
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		$respuesta = $this->c->UsuarioDAO->obtenerConID($idUsuario);
    return $respuesta;
	}

	public function obtenerConNombre($nombre)
	{
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		$respuesta = $this->c->UsuarioDAO->obtenerConNombre($nombre);
    return $respuesta;
	}

	function __destruct() {
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");      
	}

}
?>