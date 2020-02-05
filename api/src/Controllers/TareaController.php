<?php
namespace PropelORMAPI\Controllers;

use PropelORMAPI\Services\VOS\UsuarioVO;
use PropelORMAPI\Services\VOS\TareaVO;

use PropelORMAPI\Services\TareaService;

class TareaController 
{
	private $c;
	private $logger;

  public function __construct($c)
  {
    $this->c = $c;
    $this->logger = $c->get('logger');  
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");		
	}

	public function guardar($request, $response, $args)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		$enviar = true;
		$errores = "Le faltó escribir:";

		if(isset($request)){
			$data = $request->getParsedBody();
		} else {
			$respuesta = array("result"=>false,"errores"=>"Le faltó enviar los datos para guardar la tarea");
		}
		if($data["idusuario"]==null){
			$enviar = false;
			$errores.="\nid usuario";
		}
		if($data["titulo"]==null){
			$enviar = false;
			$errores.="\ntítulo de la tarea";
		}
		if($enviar){
			$usuarioVO = new UsuarioVO();
			$usuarioVO->setIdUsuario($data["idusuario"]);
			$tareaVO = new TareaVO();
			$tareaVO->setTitulo($data["titulo"]);
			$usuarioVO->agregarTarea($tareaVO);

    	$respuesta = $this->c->TareaService->guardar($usuarioVO);
		} else {
			$respuesta = array("result"=>false, "errores"=>$errores);
		}
    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
	    ->withJson($respuesta);
	}
	

	public function editar($request, $response, $args)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");
		$enviar = true;
		$errores = "Le faltó escribir:";

		if(isset($request)){
			$data = $request->getParsedBody();
		} else {
			$respuesta = array("result"=>false,"errores"=>"Le faltó enviar los datos para actualizar la tarea");
		}

		if(isset($args)){
			$idtarea = $args["idtarea"];
		} else {
			$errores ="\nId de la tarea";
			$enviar = false;
		}
		if($data["titulo"]==null){
			$enviar = false;
			$errores.="\ntítulo de la tarea";
		}
		if($data["valid"]==null){
			$enviar = false;
			$errores.="\nvalid de la tarea";
		}
		if($enviar){
			$tareaVO = new TareaVO();
			$tareaVO->setIdTarea($idtarea);
			$tareaVO->setTitulo($data["titulo"]);
			$tareaVO->setValid($data["valid"]);
    	$respuesta = $this->c->TareaService->editar($tareaVO);
		} else {
			$respuesta = array("result"=>false, "errores"=>$errores);
		}

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
	    ->withJson($respuesta);
	}
	
	public function eliminar($request, $response, $args)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		if(isset($args)){
			$idtarea = $args["idtarea"];
		} else {
			$respuesta = array("result"=>false,"errores"=>"Le faltó enviar los datos");
		}
		$enviar = true;
		$errores = "Le faltó:";
		if($idtarea==null){
			$enviar = false;
			$errores ="\nId de la tarea";
		}
		if($enviar){
			$tareaVO = new TareaVO();
			$tareaVO->setIdTarea($idtarea);
    	$respuesta = $this->c->TareaService->eliminar($tareaVO);
		} else {
			$respuesta = array("result"=>false, "errores"=>$errores);
		}

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
	    ->withJson($respuesta);
	}

	public function obtener($request, $response, $args)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		if(isset($args)){
			$pag = $args["pag"];
		} else {
			$respuesta = array("result"=>false,"errores"=>"Le faltó enviar la página");
		}
		$enviar = true;
		$errores = "Le faltó:";
		if($pag==null){
			$enviar = false;
			$errores.="\nIngresar la página";
		}
		if($enviar){
			if($pag>0){
				$pag-=1;
			} else {
				$pag = 0;
			}
    	$respuesta = $this->c->TareaService->obtener($pag);
		} else {
			$respuesta = array("result"=>false, "errores"=>$errores);
		}

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
	    ->withJson($respuesta);
	}

	public function obtenerConID($request, $response, $args)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		if(isset($args)){
			$idtarea = $args["idtarea"];
		} else {
			$respuesta = array("result"=>false,"errores"=>"Le faltó enviar el id de la tarea");
		}
		$enviar = true;
		$errores = "Le faltó:";
		if($idtarea==null){
			$enviar = false;
			$errores.="\nIngresar el id tarea";
		}
		if($enviar){
    	$respuesta = $this->c->TareaService->obtenerConID($idtarea);
		} else {
			$respuesta = array("result"=>false, "errores"=>$errores);
		}

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
	    ->withJson($respuesta);
	}

	public function obtenerConIDUsuario($request, $response, $args)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		if(isset($args)){
			$idusuario = $args["idusuario"];
		} else {
			$respuesta = array("result"=>false,"errores"=>"Le faltó enviar el id del usuario");
		}
		$enviar = true;
		$errores = "Le faltó:";
		if($idusuario==null){
			$enviar = false;
			$errores.="\nIngresar el id usuario";
		}
		if($enviar){
    	$respuesta = $this->c->TareaService->obtenerConIDUsuario($idusuario);
		} else {
			$respuesta = array("result"=>false, "errores"=>$errores);
		}

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
	    ->withJson($respuesta);
	}

	function __destruct() {
    //$this->logger->info(__CLASS__.":".__FUNCTION__."();");      
	}

}
?>