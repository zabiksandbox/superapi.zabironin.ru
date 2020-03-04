<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';



$app = new \Slim\App;

// Currency Routes
require '../src/routes/currency.php';

$app->run();