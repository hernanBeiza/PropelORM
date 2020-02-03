<?php

// Configuración para CORS y sesiones
$app->options('/{routes:.+}', function ($request, $response, $args) {
  return $response;
});

$app->add(function ($req, $res, $next) {
  //$this->logger->info("add / ");
  $origins = $this->get('settings')['origins'];
  $origin = "";
  if(isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $origins)){
      $origin = $_SERVER['HTTP_ORIGIN'];
  }
  //Obtener desde las settings el origin con permiso para consultar
  //$origin = $this->get('settings')['origin'];
  //$this->logger->info($origin);
  // Para que la aplicación cliente pueda acceder al nombre, filename, el servidor debe exponer el header "Content-Disposition"
  $response = $next($req, $res);
  return $response
    ->withHeader('Access-Control-Allow-Origin', $origin)
    ->withHeader('Access-Control-Allow-Credentials', 'true')
    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
    ->withHeader('Access-Control-Expose-Headers', 'Content-Disposition')
    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

// Rutas
$app->get('/', \IndexController::class . ':saludar');
//Usuario
$app->post('/usuario', \UsuarioController::class . ':guardar');
$app->put('/usuario/{idusuario}', \UsuarioController::class . ':editar');
$app->delete('/usuario/{idusuario}', \UsuarioController::class . ':eliminar');
$app->get('/usuario/pagina/{pag}', \UsuarioController::class . ':obtener');
$app->get('/usuario/{idusuario}', \UsuarioController::class . ':obtenerConID');
$app->get('/usuario/nombre/{nombre}', \UsuarioController::class . ':obtenerConNombre');
//Tarea
$app->post('/tarea', \TareaController::class . ':guardar');
$app->put('/tarea/{idtarea}', \TareaController::class . ':editar');
$app->delete('/tarea/{idtarea}', \TareaController::class . ':eliminar');
$app->get('/tarea/pagina/{pag}', \TareaController::class . ':obtener');
$app->get('/tarea/detalle/{idtarea}', \TareaController::class . ':obtenerConID');
$app->get('/tarea/usuario/{idusuario}', \TareaController::class . ':obtenerConIDUsuario');

//http://docs.slimframework.com/request/body/slim-3-how-to-get-all-get-put-post-variables
//http://stackoverflow.com/questions/32668186/