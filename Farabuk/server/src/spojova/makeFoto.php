<?php
require_once __DIR__ . "/../repository/AlbumRepository.php";
require_once __DIR__ . "/../repository/FotoRepository.php";
require_once __DIR__ . "/../repository/SkupinaUzivatelRepository.php";
use flight\Engine;
session_start();


if (isset($_SESSION["id"]) && SkupinaUzivatelRepository::jeOpravnen($_SESSION["id"], "fotak")){

    $tmp= new Album();
    $tmp->nazev = $_POST["nazev"];
    $tmp->ckIdObec=$_POST["obec"];
    $tmp->viditelne=1;
    if ($tmp->nazev=$_POST["nazev"]){
        $tmp->id=intval(AlbumRepository::create($tmp));
    }
    else{
        $tmp->id = $_POST['album'];
    }



    //$files = array_filter($_FILES['upload']['name']); //something like that to be used before processing files.

// Count # of uploaded files in array
    $total = count($_FILES['fotky']['name']);

// Loop through each file
    for( $i=0 ; $i < $total ; $i++ ) {

        //Get the temp file path
        $tmpFilePath = $_FILES['fotky']['tmp_name'][$i];

        //Make sure we have a file path
        if ($tmpFilePath != ""){
            //Setup our new file path
            $newFilePath = __DIR__."/../../db/files/" . $_FILES['fotky']['name'][$i];

            //Upload the file into the temp dir
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {

                //Handle other code here

            }
        }
    }



//    header('Location:/'. $_SESSION['obec']);
//    die();
}
else{
    throw new Exception("uzivatel neni opravnen");
}