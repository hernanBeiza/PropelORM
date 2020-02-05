<?php
namespace PropelORMAPI\Controllers;

use PropelORMAPI\Services\VOS\UsuarioVO;

use PropelORMAPI\Services\UsuarioService;

class UsuarioController 
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
			$respuesta = array("result"=>false,"errores"=>"Le faltó enviar los datos para guardar el usuario");
		}
		if($data["nombre"]==null){
			$enviar = false;
			$errores.="\nnombre";
		}
		if($data["apellido"]==null){
			$enviar = false;
			$errores.="\napellido";
		}
		if($data["usuario"]==null){
			$enviar = false;
			$errores.="\nusuario";
		}
		if($data["contrasena"]==null){
			$enviar = false;
			$errores.="\ncontrasena";
		}
		if($enviar){
			$usuarioVO = new UsuarioVO();
			$usuarioVO->setNombre($data["nombre"]);
			$usuarioVO->setApellido($data["apellido"]);
			$usuarioVO->setUsuario($data["usuario"]);
			$usuarioVO->setContrasena($data["contrasena"]);
    	$respuesta = $this->c->UsuarioService->guardar($usuarioVO);
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
			$respuesta = array("result"=>false,"errores"=>"Le faltó enviar los datos para actualizar la persona");
		}

		if(isset($args)){
			$idusuario = $args["idusuario"];
		} else {
			$errores ="<br/> Id de la persona";
			$enviar = false;
		}
		if($data["nombre"]==null){
			$enviar = false;
			$errores.="\nnombre";
		}
		if($data["apellido"]==null){
			$enviar = false;
			$errores.="\napellido";
		}
		if($data["usuario"]==null){
			$enviar = false;
			$errores.="\nusuario";
		}
		if($data["contrasena"]==null){
			$enviar = false;
			$errores.="\ncontrasena";
		}		
		if($data["valid"]==null){
			$enviar = false;
			$errores.="\nvalid";
		}
		if($enviar){
			$usuarioVO = new UsuarioVO();
			$usuarioVO->setIdUsuario($idusuario);
			$usuarioVO->setNombre($data["nombre"]);
			$usuarioVO->setApellido($data["apellido"]);
			$usuarioVO->setUsuario($data["usuario"]);
			$usuarioVO->setContrasena($data["contrasena"]);			
			$usuarioVO->setValid($data["valid"]);			
    	$respuesta = $this->c->UsuarioService->editar($usuarioVO);
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
			$idusuario = $args["idusuario"];
		} else {
			$respuesta = array("result"=>false,"errores"=>"Le faltó enviar los datos");
		}
		$enviar = true;
		$errores = "Le faltó:";
		if($idusuario==null){
			$enviar = false;
			$errores.="n\Escoger el usuario";
		}
		if($enviar){
			$usuarioVO = new UsuarioVO();
			$usuarioVO->setIdUsuario($idusuario);
    	$respuesta = $this->c->UsuarioService->eliminar($usuarioVO);
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
			$errores.="n\Ingresar la página";
		}
		if($enviar){

			if($pag>0){
				$pag-=1;
			} else {
				$pag = 0;
			}

    	$respuesta = $this->c->UsuarioService->obtener($pag);
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
			$idusuario = $args["idusuario"];
		} else {
			$respuesta = array("result"=>false,"errores"=>"Le faltó enviar el id del usuario");
		}
		$enviar = true;
		$errores = "Le faltó:";
		if($idusuario==null){
			$enviar = false;
			$errores.="n\Ingresar el id del usuario";
		}
		if($enviar){
    	$respuesta = $this->c->UsuarioService->obtenerConID($idusuario);
		} else {
			$respuesta = array("result"=>false, "errores"=>$errores);
		}

    return $response->withStatus(200)
      ->withHeader('Content-Type', 'application/json')
	    ->withJson($respuesta);
	}

	public function obtenerConNombre($request, $response, $args)
	{
    $this->logger->info(__CLASS__.":".__FUNCTION__."();");		
		if(isset($args)){
			$nombre = $args["nombre"];
		} else {
			$respuesta = array("result"=>false,"errores"=>"Le faltó enviar el nombre del usuario");
		}
		$enviar = true;
		$errores = "Le faltó:";
		if($nombre==null){
			$enviar = false;
			$errores.="n\Ingresar el nombre del usuario";
		}
		if($enviar){
    	$respuesta = $this->c->UsuarioService->obtenerConNombre($nombre);
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