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
    
    $total = count($_FILES['fotky']['name']);
//    echo $total;
// Loop through each file
//    print "<pre>";
//    print_r($_FILES['fotky']['name']);
//    echo "<br>";
//    print "</pre>";
    for( $i=0 ; $i < $total ; $i++ ) {
        $tmpPozice=__DIR__ . "/../../../server/db/tmp/".basename($_FILES["fotky"]["name"][$i]);
        //Get the temp file path
        $tmpFilePath = $_FILES['fotky']['tmp_name'][$i];
        if (isset($_SERVER["CONTENT_LENGTH"]) && (int)$_SERVER["CONTENT_LENGTH"] > (10 * 1024 * 1024)) {
            throw new Exception("Tento soubor je příliš velký!");
        }


//        echo $tmpFilePath. "<br>";
        if ($tmpFilePath != ""){
            $pripona = image_type_to_extension(exif_imagetype($tmpFilePath));
            $hashName = hash_file("sha256", $_FILES["fotky"]["tmp_name"][$i]);
            if (!in_array(exif_imagetype($tmpFilePath), [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP, IMAGETYPE_GIF])) {
                throw new Exception("Tento formát souboru není námi podporovaný!");
            }
            //Setup our new file path
            $newFilePath = __DIR__ . "/../../../server/db/files/" . $hashName . $pripona;
            //Upload the file into the temp dir
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                //Handle other code here
                $data= new Foto();
                $data->datum=date('d.m.Y');
                $data->nazevSouboru=$hashName.$pripona;
                $data->ckIdAlbum=$tmp->id;
                $data->sirka = 0;
                $data->viditelna=1;
                FotoRepository::create($data);

            }
        }
    }

    /*
     * /^[a-z0-9-]+$/g
    urlencode, podle nadpisu, jen pokud neni nastaven uz uri
    projet regexem (a-z a pomlcka) preg_match
    unikatnost obec-druh-uri
    */


    header('Location:/'. $_SESSION['obec']);
    die();
}
else{
    throw new Exception("uzivatel neni opravnen");
}