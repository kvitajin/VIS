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
    require __DIR__ ."/../../src/spojova/makeLogin.php";
});
$app->route('POST /makeRegister', function (){
    require __DIR__ ."/../../src/spojova/makeRegister.php";
});
$app->route('/odhlas', function (){
    require __DIR__ ."/../../../client/stranky/logout.php";
});
$app->route('/erb', function (){
    require __DIR__ ."/../../../server/static/img/erb.png";
});
$app->route('/error', function (){
    require __DIR__ ."/../../../server/static/error.php";
});
$app->route('/dokumenty', function (){
    require __DIR__ ."/../../../client/stranky/dokumenty.php";
});
$app->route('/tvorbaDokumentu', function (){
    require __DIR__ ."/../../../client/stranky/tvorbaDokumentu.php";
});
$app->route('/makeDokument', function (){
    require __DIR__ ."/../../../server/src/spojova/makeDokument.php";
});
$app->route('GET /@obec', function ($obec){
    Flight::set('obec', $obec) ;
    $_SESSION['obec']=$obec;
    require __DIR__ ."/../../../client/stranky/obec.php";
});
$app->route('GET /@obec/dokumenty', function ($obec){
    $_SESSION['obec']=$obec;
    require __DIR__ ."/../../../client/stranky/dokumenty.php";
});
$app->route('GET /@obec/alba', function ($obec){
    $_SESSION['obec']=$obec;
    require __DIR__ ."/../../../client/stranky/alba.php";
});





$app->start();


//
//Flight::route('POST /',function (){
//    require __DIR__ ."/../../../client/index.php";
//});
//Flight::route('GET /@obec', function ($obec){
//    require __DIR__ ."/../../../client/stranky/obec.php";
//});
