<?php
session_start();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './../vendor/autoload.php';

// setup Propel
require_once './../src/DAOS/config.php';
/*
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
$defaultLogger = new Logger('defaultLogger');
$defaultLogger->pushHandler(new StreamHandler('./../logs/propel_error.log', Logger::WARNING));
Propel::getServiceContainer()->setLogger('defaultLogger', $defaultLogger);
$queryLogger = new Logger('bookstore');
$queryLogger->pushHandler(new StreamHandler('./../logs/propel_query.log'));
Propel::getServiceContainer()->setLogger('bookstore', $queryLogger);
*/

ini_set('date.timezone', 'America/Santiago');

$app = (new PropelORMAPI\App())->get();

$app->run();