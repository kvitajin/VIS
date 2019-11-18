<?php

require_once "Reporitory.php";
require_once "src/data/Skupina.php";
use Connection\Connection;


class SkupinaRepository extends Repository {
    static function getTableName() {
        return "skupina";
    }
    static function readAllDeep($lim) {
        return parent::readAll($lim);
    }

    static function readAllRearDeep($lim, $deep) {
        return parent::readAll($lim);
    }

    static function readDeep($id) {
        return parent::read($id);
    }

    static function readRearDeep($id, $deep) {
        return parent::read($id);
    }

    static function update($data) {
        Connection::pdo()->beginTransaction();
        $table = self::getTableName();
        $idSkupina = $data->id;
        if ($data->nazev) {
            $sql = "UPDATE ${table} SET nazev=(:nazev) WHERE id=${idSkupina}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':nazev', $data->nazev);
            $statement->execute();
        }
        if ($data->opravneni) {
            $table = self::getTableName();
            $sql = "UPDATE ${table} SET opravneni=(:opravneni) WHERE id=${idSkupina}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':opravneni', $data->opravneni);
            $statement->execute();
        }
        Connection::pdo()->commit();
    }

    static function create($data) {
        $table = self::getTableName();
        $sql = "INSERT INTO ${table}(nazev, opravneni) 
	    VALUES (:nazev, :opravneni)";
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute(array(
            ':nazev' => $data->nazev,
            ':opravneni' => $data->opravneni
        ));
        return Connection::pdo()->lastInsertId();
    }

    static function createDeep($data) {
        return self::create($data);
    }
}