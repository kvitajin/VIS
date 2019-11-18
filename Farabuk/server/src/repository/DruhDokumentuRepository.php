<?php
require_once "Reporitory.php";
require_once "src/data/DruhDokumentu.php";
use Connection\Connection;



class DruhDokumentuRepository extends Repository {
    static function getTableName(){
        return "druh_dokumentu";
    }
    
    static function readAllDeep($lim) {
        // TODO: Implement readAllDeep() method.
    }

    static function readAllRearDeep($lim, $deep) {
        // TODO: Implement readAllRearDeep() method.
    }

    static function readDeep($id) {
        // TODO: Implement readDeep() method.
    }

    static function readRearDeep($id, $deep) {
        // TODO: Implement readRearDeep() method.
    }

    static function update($data) {
        // TODO: Implement update() method.
    }

    static function create($data) {
        // TODO: Implement create() method.
    }

    static function createDeep($data) {
        // TODO: Implement createDeep() method.
    }
}