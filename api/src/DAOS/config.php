<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('tareaconnection', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
  'dsn' => 'mysql:host=mihost;dbname=midb;charset=utf8',
  'user' => 'miusuario',
  'password' => 'micontrasena',
  'attributes' =>
  array (
    'ATTR_EMULATE_PREPARES' => false,
    'ATTR_TIMEOUT' => 30,
  ),
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('tareaconnection');
$serviceContainer->setConnectionManager('tareaconnection', $manager);
$serviceContainer->setDefaultDatasource('tareaconnection');
$serviceContainer->setLoggerConfiguration('defaultLogger', array (
  'type' => 'stream',
  'path' => './../logs/propel.log',
  'level' => 300,
));
$serviceContainer->setLoggerConfiguration('tareaconnection', array (
  'type' => 'stream',
  'path' => './../logs/propel_db.log',
));