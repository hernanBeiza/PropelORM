<?php
return [
  'settings' => [
    'origins' => [
      'http://localhost:4200'
    ],
    'displayErrorDetails' => true, // set to false in production
    'addContentLengthHeader' => false, // Allow the web server to send the content-length header

    'env' => 'LOCAL',

    'codification' => "HS256",     

    'api' => "https://api.cliengo.com/1.0/",

    // Renderer settings
    'renderer' => [
      'template_path' => __DIR__ . '/../templates/',
    ],

    'version' => 0.1,

    // Monolog settings
    'logger' => [
      'name' => 'propelormapi',
      'path' => __DIR__ . '/../logs/api.log',
      'level' => \Monolog\Logger::DEBUG,
    ],
  ],
];