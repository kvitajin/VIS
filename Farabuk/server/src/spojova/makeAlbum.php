<?php
require_once __DIR__ . "/../repository/AlbumRepository.php";
require_once __DIR__ . "/../repository/SkupinaUzivatelRepository.php";
use flight\Engine;
session_start();


if (SkupinaUzivatelRepository::jeOpravnen($_SESSION["id"], "fotak")){
    $tmp= new Album();
    $tmp->nazev = $_POST["nazev"];
    $tmp->ckIdObec=$_POST["obec"];
    $tmp->viditelne=1;

    $tmp->id=intval(AlbumRepository::create($tmp));

    header('Location:/'. $_SESSION['obec']);
    die();
}
else{
    throw new Exception("uzivatel neni prihlasen");
}