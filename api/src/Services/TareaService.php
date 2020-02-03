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
		$usuario = UsuarioQuery::create()->findPK($usuarioVO->getIdUsuario());
		foreach ($usuarioVO->getTareasVO() as $tareaVO) {
			$tarea = new Tarea();
			$tarea->setTitulo($tareaVO->getTitulo());
			//El segundo parámetro es idusuariotarea
			$usuario->addTarea($tarea,null);
		}
		$usuario->save();
		if($usuario!=null){
			$respuesta = array("result"=>true,"tarea"=>null,"mensajes"=>"Tareas guardadas correctamente");
			$respuesta["tarea"] = TareaVO::withTarea($tarea)->jsonSerialize();
		} else {
			$respuesta = array("result"=>false,"usuario"=>null,"errores"=>"La tareas no se han guardado");
		}    	
    return $respuesta;
	}
	
	public function editar($tareaVO)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");
		$tarea = TareaQuery::create()->findPK($tareaVO->getIdTarea());
		if($tarea!=null){
			$tarea->setTitulo($tareaVO->getTitulo());
			$tarea->save();
			$respuesta = array("result"=>true,"tarea"=>null,"mensajes"=>"Tarea editada correctamente");
			$respuesta["tarea"] = TareaVO::withTarea($tarea)->jsonSerialize();
		} else {
			$respuesta = array("result"=>false,"tarea"=>null,"errores"=>"La tarea no se ha editado");
		}
    return $respuesta;
	}
	
	public function eliminar($tareaVO)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		$usuarioTarea = UsuarioTareaQuery::create()->findOneByIdTarea($tareaVO->getIdTarea());
		if($usuarioTarea){
			$usuarioTarea->delete();
			if($usuarioTarea->isDeleted()){
				$respuesta = array("result"=>true,"mensajes"=>"Tarea eliminada correctamente");
			} else {
				$respuesta = array("result"=>false,"errores"=>"La tarea no se ha eliminado");
			}
		} else {			
				$respuesta = array("result"=>false,"errores"=>"No existe tarea con ese id");
		}
    return $respuesta;
	}

	public function obtener($pag)
	{
		//Ejemplos de log
		/*
		use PropelORMAPI\DAOS\Map\UsuarioTableMap;
		\Propel\Runtime\Propel::getConnection()->useDebug(true);
		$con = \Propel\Runtime\Propel::getWriteConnection(UsuarioTableMap::DATABASE_NAME);
		$con->useDebug(true);

		\Propel\Runtime\Propel::log('uh-oh, something went wrong with ', \Monolog\Logger::ERROR);
		\Propel\Runtime\Propel::log('uh-oh, something went wrong with ', \Monolog\Logger::WARNING);
		*/

    $resultadosPorPagina = 2;
		$tareas = TareaQuery::create()->limit($resultadosPorPagina)->offset($resultadosPorPagina*$pag)->find();

		if(count($tareas)>0){
			//TODO Mejorar
			//Pasar la colleción de propel a un arreglo para poder usarlo en array_map 
			$items = array();
			foreach ($tareas as $item) {
				array_push($items,$item);
			}
			$respuesta = array('result'=>true,'tareas'=>$items, 'mensajes'=>"Tareas encontrados");
			$respuesta["tareas"] = array_map(function($tarea){
				return TareaVO::withTarea($tarea)->jsonSerialize();
			},$respuesta["tareas"]);

		} else {
			$respuesta = array('result'=>false,'tareas'=>null, 'errores'=>"No se han encontrado tareas");
		}

    return $respuesta;
	}

	public function obtenerConID($idTarea)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		$tarea = TareaQuery::create()->findPK($idTarea);
		if($tarea){
			$respuesta = array('result'=>true,'tarea'=>null, 'mensajes'=>"Tarea encontrada");
			$respuesta["tarea"] = TareaVO::withTarea($tarea)->jsonSerialize();
		} else {
			$respuesta = array('result'=>false,'usuario'=>null, 'mensajes'=>"Tarea no encontrada");
		}
    return $respuesta;
	}

	public function obtenerConIDUsuario($idUsuario)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");
		$usuario = UsuarioQuery::create()->findPK($idUsuario);
    $this->logger->info(__CLASS__.":".__FUNCTION__."(); ".$usuario->toJSON());		

		if(count($usuario)>0){
			//TODO Mejorar
			//Pasar la colleción de propel a un arreglo para poder usarlo en array_map 
			$items = array();
			foreach ($usuario->getTareas() as $tarea) {
				array_push($items,$tarea);
			}
			$respuesta = array('result'=>true,'tareas'=>$items, 'mensajes'=>"Tareas encontradas");
			$respuesta["tareas"] = array_map(function($tarea){
	    $this->logger->info(__CLASS__.":".__FUNCTION__."(); ".$tarea);		
				return TareaVO::withTarea($tarea)->jsonSerialize();
			},$respuesta["tareas"]);

		} else {
			$respuesta = array('result'=>false,'tareas'=>null, 'errores'=>"No se han encontrado tareas");
		}

    return $respuesta;
	}

	function __destruct() {
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");      
	}

}
?>