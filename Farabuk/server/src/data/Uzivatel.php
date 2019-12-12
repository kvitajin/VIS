<?php
require_once __DIR__ . "/../repository/Connection.php";
require_once __DIR__ . "/../repository/Repository.php";
require_once __DIR__ . "/../data/Skupina.php";
require_once __DIR__ . "/../data/SkupinaUzivatel.php";

//TODO dodat dataFily

class Uzivatel {
    public $id;
    public $nick;
    public $heslo;
    public $hesloZnova;
    public $email;
    public $datumNarozeni;
    public $ban;
    public $ckIdObec;
    public $skupina= array();
    public $likeFoto=array();
    public $likeKomentar=array();
    public $likeDokument=array();
    public $komentar=array();
}