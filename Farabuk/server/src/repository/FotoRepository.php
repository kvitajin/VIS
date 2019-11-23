<?php
require_once "src/data/Foto.php";
use Connection\Connection;

class FotoRepository extends Repository {

    static function getTableName() {
        return "foto";
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

    }

    static function createDeep($data) {
        // TODO: Implement createDeep() method.
    }

    static function readAllAlbum($id){
        $sql = "SELECT * FROM " . static::getTableName() . " WHERE ck_id_album=" . $id;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        $i = 0;
        while ($records[$i] = $statement->fetch(PDO::FETCH_ASSOC)) {
            $i++;
        }
        return $records;
    }

}