<?php
use Connection\Connection;
require_once __DIR__ . "/../repository/Connection.php";
abstract class Repository {
    abstract static function getTableName();

    static function readAll($lim = 99) {
        //tested
        $sql = "SELECT * FROM " . static::getTableName() . " LIMIT " . $lim;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        $i = 0;
        while ($records[$i] = $statement->fetch(PDO::FETCH_ASSOC)) {
            $i++;
        }
        return $records;
    }
    abstract static function readAllDeep($lim);
    abstract static function readAllRearDeep($lim, $deep);
    static function read($id) {
        //tested
        $sql = "SELECT * FROM " . static::getTableName() . " WHERE id=" . $id;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        return $record;
    }
    abstract static function readDeep($id);
    abstract static function readRearDeep($id, $deep);
    abstract static function update($data);
    static function delete($id) {
        $sql = "DELETE FROM " . static::getTableName() . " WHERE id=" . $id;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        return true;
    }
    abstract static function create($data);
    abstract static function createDeep($data);
}