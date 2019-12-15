<?php
require_once __DIR__ . "/../repository/SkupinaUzivatelRepository.php";
require_once __DIR__ . "/../repository/DokumentObecRepository.php";
use flight\Engine;
session_start();


if (SkupinaUzivatelRepository::jeOpravnen($_SESSION["id"], "komentator")){
    $tmp= new Dokument();
    $tmp->nadpis = $_POST["nadpis"];
    $tmp->podnadpis = $_POST["podnadpis"];
    $tmp->uri = $_POST["uri"];
    $tmp->obsah = $_POST["obsah"];
    $tmp->ckIdDruhDokumentu = $_POST["druh"];
    $tmp->ckIdKategorieDokumentu = $_POST["kategorie"];
    $obce=array();
    $i = 0;
    foreach ($_POST["obec"] as $key => $value) {
        if(!$value){continue;}
        $obce[$i] = intval($value);
        $i++;
    }
    $tmp->datum = date('d.m.Y');
    //$cil = NULL;   //pokud tam je obrazek, tak se prepise
//
//    print "<pre>";
//    print_r($tmp);
//    print_r($obce);
//    echo "<br>";
//    print "</pre>";


//    if (isset ($_FILES["obrazek"])) {
//        if (isset($_SERVER["CONTENT_LENGTH"]) && (int)$_SERVER["CONTENT_LENGTH"] > (10 * 1024 * 1024)) {
//            throw new Exception("Tento soubor je příliš velký!");
//        }
//        $tmp = $_FILES["obrazek"]["tmp_name"];
//        $pripona = image_type_to_extension(exif_imagetype($tmp));
//        $hashName = hash_file("sha256", $_FILES["obrazek"]["tmp_name"]);
//        $cil = __DIR__ . "../static/db/img/" . $hashName . $pripona;
//        if (!in_array(exif_imagetype($tmp), [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP, IMAGETYPE_GIF])) {
//            throw new Exception("Tento formát souboru není námi podporovaný!");
//        }
//        $sirka = getimagesize($cil);
//        $database->createPicture($datum, $sirka[0], $hashName);
//    }
//    /*
//     * /^[a-z0-9-]+$/g
//    urlencode, podle nadpisu, jen pokud neni nastaven uz uri
//    projet regexem (a-z a pomlcka) preg_match
//    unikatnost obec-druh-uri
//    */
    $tmp->id=intval(DokumentRepository::create($tmp));
    foreach ($obce as $item){
        DokumentObecRepository::create($tmp->id, $item);
    }
    header('Location:/'. $_SESSION['obec']);
    die();
}
else{
    throw new Exception("uzivatel neni prihlasen");
}