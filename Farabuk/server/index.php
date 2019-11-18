<?php
require_once "src/repository/ObecRepository.php";

\Connection\Connection::getConnection();
$obec = new Obec();
$obec->erb="sdjnskcjsndckjsns";
$obec->nazev="Rybi";
$obec->uri="rybi";
var_dump(ObecRepository::create($obec));