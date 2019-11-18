<?php

require_once "Repository.php";
require_once "src/data/Uzivatel";
require_once "SkupinaRepository.php";


class UzivatelRepository extends Repository {

    static function read($id) {
        $sql = "SELECT * FROM " . static::getTableName() . " WHERE id=" . $id;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        return $record;

        //TODO: dodelat az bude hotova tabulka skupina_uzivatel
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