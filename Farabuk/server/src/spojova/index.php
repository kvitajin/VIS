<?php

require 'flight/Flight.php';

Flight::route('POST /',function (){
    require __DIR__ ."/../../../client/index.php";
});
Flight::route('GET /@obec', function ($obec){
    require __DIR__ ."/../../../client/stranky/obec.php";
});
