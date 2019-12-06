<?php
require_once "src/repository/Repository.php";


class Dokument {
    public $id;
    public $nadpis;
    public $podnadpis;      //perex
    public $uri;
    public $obsah;
    public $datum;
    public $datumVyveseni;
    public $datumStazeni;
    public $obrazek;
    public $ckIdDruhDokumentu;
    public $ckIdKategorieDokumentu;

}