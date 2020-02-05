<?php
namespace PropelORMAPI\DAOS;

use PropelORMAPI\Services\VOS\UsuarioVO;

use PropelORMAPI\ORM\Usuario;
use PropelORMAPI\ORM\UsuarioQuery;

class UsuarioDAO
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
		$usuario = new Usuario();
		$usuario->setNombre($usuarioVO->getNombre());
		$usuario->setApellido($usuarioVO->getApellido());
		$usuario->setUsuario($usuarioVO->getUsuario());
		$usuario->setContrasena($usuarioVO->getContrasena());
		$usuario->save();

		if($usuario!=null){
			$usuarioCreado = UsuarioQuery::create()->findPK($usuario->getIdUsuario());
	    $this->logger->info(__CLASS__.":".__FUNCTION__."(); ".$usuarioCreado->toJSON());
			$respuesta = array("result"=>true,"usuario"=>null,"mensajes"=>"Usuario creado correctamente");
			$respuesta["usuario"] = UsuarioVO::withUsuario($usuarioCreado)->jsonSerialize();
		} else {
			$respuesta = array("result"=>false,"usuario"=>null,"errores"=>"El usuario no se ha creado");
		}
    return $respuesta;
	}
	
	public function editar($usuarioVO)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");
		$usuario = UsuarioQuery::create()->findPK($usuarioVO->getIdUsuario());
		$usuario->setNombre($usuarioVO->getNombre());
		$usuario->setApellido($usuarioVO->getApellido());
		$usuario->setUsuario($usuarioVO->getUsuario());
		$usuario->setContrasena($usuarioVO->getContrasena());
		$usuario->setValid($usuarioVO->getValid());
		$usuario->save();
		if($usuario!=null){
			$respuesta = array("result"=>true,"usuario"=>null,"mensajes"=>"Usuario editado correctamente");
			$respuesta["usuario"] = UsuarioVO::withUsuario($usuario)->jsonSerialize();
		} else {
			$respuesta = array("result"=>false,"usuario"=>null,"errores"=>"El usuario no se ha editado");
		}
    return $respuesta;
	}
	
	public function eliminar($usuarioVO)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		$usuario = UsuarioQuery::create()->findPK($usuarioVO->getIdUsuario());
		if($usuario){
			$this->logger->info(__CLASS__.":".__FUNCTION__."(); ".$usuario->toJSON());		
			$usuario->delete();
			if($usuario->isDeleted()){
				$respuesta = array("result"=>true,"mensajes"=>"Usuario eliminado correctamente");
			} else {
				$respuesta = array("result"=>false,"errores"=>"El usuario no se ha eliminado");
			}
		} else {			
				$respuesta = array("result"=>false,"errores"=>"No existe usuario con ese id");
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
		*/
		/*
		\Propel\Runtime\Propel::log('uh-oh, something went wrong with ', \Monolog\Logger::ERROR);
		\Propel\Runtime\Propel::log('uh-oh, something went wrong with ', \Monolog\Logger::WARNING);
		*/
    $resultadosPorPagina = 2;
		$usuarios = UsuarioQuery::create()->limit($resultadosPorPagina)->offset($resultadosPorPagina*$pag)->find();

		if(count($usuarios)>0){
			//TODO Mejorar
			//Pasar la colleción de propel a un arreglo para poder usarlo en array_map 
			$items = array();
			foreach ($usuarios as $item) {
				array_push($items,$item);
			}
			$respuesta = array('result'=>true,'usuarios'=>$items, 'mensajes'=>"Usuarios encontrados");

			$respuesta["usuarios"] = array_map(function($usuario){
				return UsuarioVO::withUsuario($usuario)->jsonSerialize();
			},$respuesta["usuarios"]);

		} else {
			$respuesta = array('result'=>false,'usuarios'=>null, 'errores'=>"No se han encontrado usuario");
		}

    return $respuesta;
	}

	public function obtenerConID($idUsuario)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		$usuario = UsuarioQuery::create()->findPK($idUsuario);
		if($usuario){
			$respuesta = array('result'=>true,'usuario'=>null, 'mensajes'=>"Usuario encontrado");
			$respuesta["usuario"] = UsuarioVO::withUsuario($usuario)->jsonSerialize();
		} else {
			$respuesta = array('result'=>false,'usuario'=>null, 'mensajes'=>"Usuario no encontrado");
		}
    return $respuesta;
	}

	public function obtenerConNombre($nombre)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");
		$usuarios = UsuarioQuery::create()->filterByNombre($nombre)->find();

		if(count($usuarios)>0){
			//TODO Mejorar
			//Pasar la colleción de propel a un arreglo para poder usarlo en array_map 
			$items = array();
			foreach ($usuarios as $item) {
				array_push($items,$item);
			}
			$respuesta = array('result'=>true,'usuarios'=>$items, 'mensajes'=>"Usuarios encontrados");
			
			$respuesta["usuarios"] = array_map(function($usuario){
	    $this->logger->info(__CLASS__.":".__FUNCTION__."(); ".$usuario);		
				return UsuarioVO::withUsuario($usuario)->jsonSerialize();
			},$respuesta["usuarios"]);

		} else {
			$respuesta = array('result'=>false,'usuarios'=>null, 'errores'=>"No se han encontrado usuarios");
		}

    return $respuesta;
	}

	function __destruct() {
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");      
	}

}
?>