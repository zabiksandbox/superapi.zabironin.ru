<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$db = new db();
$db = $db->connect();



$app = new \Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Content-Type', 'application/json');
});
$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("So empty, so dark :(");
    return $response;
});
// Get All currency
$app->get('/currencies', function(Request $request, Response $response){
	global $db;
	
	$default_perpage=5; // это хорошо бы в конфиг

	$reqparams=$request->getQueryParams();
	$reqparams['page']=intval($reqparams['page']<0?0:$reqparams['page']);
	$reqparams['perpage']=intval($reqparams['perpage']<=0?$default_perpage:$reqparams['perpage']);

    $sql = "SELECT * FROM currency LIMIT ".($reqparams['page']*$reqparams['perpage']).", ".$reqparams['perpage'];
  
    try{
        
        $stmt = $db->query($sql);
        $currencies = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($currencies);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});



// Get Single currency
$app->get('/currency/{id}', function(Request $request, Response $response){
	global $db;
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM currency WHERE id = '".$id."'";

    try{
        $stmt = $db->query($sql);
        $currency = $stmt->fetch(PDO::FETCH_OBJ);
        $currency->rate=number_format($currency->rate/10000,4,'.','');

        $db = null;
        echo json_encode($currency);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});