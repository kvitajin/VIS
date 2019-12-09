<?php
require_once __DIR__ .  "/../repository/Repository.php";


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