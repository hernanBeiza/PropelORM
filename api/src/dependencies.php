<?php

$container = $app->getContainer();

// view renderer
/*
$container['renderer'] = function ($c) {
  $settings = $c->get('settings')['renderer'];
  return new Slim\Views\PhpRenderer($settings['template_path']);
};
*/

// monolog
$container['logger'] = function ($c) {
  $settings = $c->get('settings')['logger'];
  $logger = new Monolog\Logger($settings['name']);
  $logger->pushProcessor(new Monolog\Processor\UidProcessor());
  $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
  $handler = new Monolog\Handler\RotatingFileHandler($settings["path"],100, $settings["level"], true, 0664);
  # '/' in date format is treated like '/' in directory path
  # so Y/m/d-filename will create path: eg. 2017/07/21-filename.log
  //$handler->setFilenameFormat('{date}-{filename}', 'Y/m/d');
  # so Y/m-filename will create path: eg. 2017/07-filename.log    
  $handler->setFilenameFormat('{date}-{filename}', 'Y/m');

  $logger->pushHandler($handler);
  return $logger;
};

// Llave de autentificación, ahora en settings
// $container['secret'] = 'HAHiperKey';

// Configuración
$container['Config'] = function ($c) {
  return new \PropelORMAPI\Config($c);
};
// Manejar errores, exceptiones try catch
/*
$container['errorHandler'] = function ($c) {
  return new \PropelORMAPI\CustomExceptionHandler();
};
*/

// DAOS
$container['DBDAO'] = function ($c) {
  return new \PropelORMAPI\DAOS\DBDAO($c);
};
$container['IndexDAO'] = function ($c) {
  return new \PropelORMAPI\DAOS\IndexDAO($c);
};
$container['UsuarioDAO'] = function ($c) {
  return new \PropelORMAPI\DAOS\UsuarioDAO($c);
};
$container['TareaDAO'] = function ($c) {
  return new \PropelORMAPI\DAOS\TareaDAO($c);
};
// Models DAOS
$container['Index'] = function ($c) {
  return new \PropelORMAPI\DAOS\Models\Index();
};
// Controllers
$container['IndexController'] = function ($c) {
  return new \PropelORMAPI\Controllers\IndexController($c);
};
$container['UsuarioController'] = function ($c) {
  return new \PropelORMAPI\Controllers\UsuarioController($c);
};
$container['TareaController'] = function ($c) {
  return new \PropelORMAPI\Controllers\TareaController($c);
};
// Services
$container['IndexService'] = function ($c) {
  return new \PropelORMAPI\Services\IndexService($c);
};
$container['UsuarioService'] = function ($c) {
  return new \PropelORMAPI\Services\UsuarioService($c);
};
$container['TareaService'] = function ($c) {
  return new \PropelORMAPI\Services\TareaService($c);
};
// VOS
$container['IndexVO'] = function ($c) {
  return new \PropelORMAPI\Services\VOS\IndexVO($c);
};
$container['UsuarioVO'] = function ($c) {
  return new \PropelORMAPI\Services\VOS\UsuarioVO($c);
};
$container['UsuarioTareaVO'] = function ($c) {
  return new \PropelORMAPI\Services\VOS\UsuarioTareaVO($c);
};
$container['TareaVO'] = function ($c) {
  return new \PropelORMAPI\Services\VOS\TareaVO($c);
};
