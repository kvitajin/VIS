<?php
require_once "Reporitory.php";
require_once "src/data/Obec.php";
use Connection\Connection;


class ObecRepository extends Repository {
    static function getTableName() {
        return "obec";
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
        $idObec = $data->id;
        //var_dump($data);
        if ($data->erb) {
            $sql = "UPDATE ${table} SET erb=(:erb) WHERE id=${idObec}";
            //var_dump($sql);
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':name', $data->erb);
            $statement->execute();
        }
        if ($data->nazev) {
            $table = self::getTableName();
            $sql = "UPDATE ${table} SET nazev=(:nazev) WHERE id=${idObec}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':nazev', $data->nazev);
            $statement->execute();
        }
        if ($data->uri) {
            $sql = "UPDATE ${table} SET uri=(:uri) WHERE id=${idObec}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':uri', $data->uri);
            $statement->execute();
        }
        if ($data->viditelna) {
            $sql = "UPDATE ${table} SET viditelna=(:viditelna) WHERE id=${idObec}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':viditelna', $data->viditelna);
            $statement->execute();
        }
        Connection::pdo()->commit();
    }

    static function create($data) {
        $table = self::getTableName();
        $sql = "INSERT INTO ${table}(erb, nazev, uri) 
	    VALUES (:erb, :nazev, :uri)";
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute(array(
            ':erb' => $data->erb,
            ':nazev' => $data->nazev,
            ':uri' => $data->uri
        ));
        return Connection::pdo()->lastInsertId();
    }

    static function createDeep($data) {
        return self::create($data);
    }
}