<?php
require __DIR__ . '/../../vendor/autoload.php';

use flight\Engine;


$app = new Engine();

$app->route('/', function(){
    require __DIR__ ."/../../../client/index.php";
});

$app->route('/prihlaseni', function (){
    require __DIR__ ."/../../../client/stranky/login.php";
});
$app->route('/registrace', function (){
    require __DIR__ ."/../../../client/stranky/singup.php";
});
$app->route('POST /makeLogin', function (){
    require __DIR__ ."/../../../server/src/spojova/makeLogin.php";
});
$app->route('POST /makeRegister', function (){
    require __DIR__ ."/../../../server/src/spojova/makeRegister.php";
});
$app->route('GET /@obec', function ($obec){
    Flight::set('obec', $obec) ;
    require __DIR__ ."/../../../client/stranky/obec.php";
});




$app->start();


//
//Flight::route('POST /',function (){
//    require __DIR__ ."/../../../client/index.php";
//});
//Flight::route('GET /@obec', function ($obec){
//    require __DIR__ ."/../../../client/stranky/obec.php";
//});
