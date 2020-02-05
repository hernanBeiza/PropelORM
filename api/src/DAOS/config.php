<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('tareaconnection', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
  'dsn' => 'mysql:host=192.168.56.101;dbname=tareadb;charset=utf8',
  'user' => 'root',
  'password' => '0C3v8ea0',
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