<?php
namespace PropelORMAPI\Services;

use PropelORMAPI\Services\VOS\UsuarioVO;
use PropelORMAPI\Services\VOS\TareaVO;

use PropelORMAPI\DAOS\Usuario;
use PropelORMAPI\DAOS\UsuarioQuery;

use PropelORMAPI\DAOS\Tarea;
use PropelORMAPI\DAOS\TareaQuery;

use PropelORMAPI\DAOS\UsuarioTarea;
use PropelORMAPI\DAOS\UsuarioTareaQuery;

class TareaService 
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
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");
    $respuesta = $this->c->TareaDAO->guardar($usuarioVO);
    return $respuesta;
	}
	
	public function editar($tareaVO)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");
    $respuesta = $this->c->TareaDAO->editar($tareaVO);
    return $respuesta;
	}
	
	public function eliminar($tareaVO)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");		
    $respuesta = $this->c->TareaDAO->eliminar($tareaVO);
    return $respuesta;
	}

	public function obtener($pag)
	{    
		$respuesta = $this->c->TareaDAO->obtener($pag);
    return $respuesta;
	}

	public function obtenerConID($idTarea)
	{
		$respuesta = $this->c->TareaDAO->obtenerConID($idTarea);
    return $respuesta;
	}

	public function obtenerConIDUsuario($idUsuario)
	{
		$respuesta = $this->c->TareaDAO->obtenerConIDUsuario($idUsuario);
    return $respuesta;
	}

	function __destruct() {
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");      
	}

}
?>