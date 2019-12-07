<?php
require_once __DIR__ ."/../repository/Repository.php";


class Album {
    public $id;
    public $nazev;
    public $jeUvodni;
    public $viditelne;
    public $ckIdObec;
    public $foto = array();
}