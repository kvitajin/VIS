<?php
require_once __DIR__ . "/../repository/UzivatelRepository.php";
require_once __DIR__ . "/../repository/ObecRepository.php";
//require_once __DIR__ . '/../../common/Log.php';
session_start();
$error = 0;
$tmp=new Uzivatel();

$tmp->nick = $_POST["nick"];
$tmp->heslo = $_POST["heslo"];
$tmp->hesloZnova = $_POST["hesloZnova"];
var_dump($_POST["obec"]);
$tmp->ckIdObec = $_POST["obec"];
$tmp->email = $_POST["email"];

$tmp->datumNarozeni = $_POST["datumNarozeni"];

$tmp->email = strtolower($tmp->email);

try {
    var_dump(UzivatelRepository::create($tmp));

} catch (Exception $e) {
    echo "tu";
    echo $e->getMessage();
    Log::msg($e->getMessage(), 'SYSTEM');
}
header("location:/".$_SESSION['obec']);
die();