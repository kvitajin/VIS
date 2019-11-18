<?php
require_once "src/repository/Connection.php";
require_once "src/repository/Repository.php";
require_once "Skupina.php";

//TODO dodat dataFily

class Uzivatel {
    public $id;
    public $nick;
    protected $heslo;
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