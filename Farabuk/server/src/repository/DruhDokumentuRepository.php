<?php
require_once "Repository.php";
require_once "src/data/DruhDokumentu.php";
use Connection\Connection;

//TODO dodat do deepu vsechny dokumenty

class DruhDokumentuRepository extends Repository {
    static function getTableName(){
        return "druh_dokumentu";
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
        $idDruh = $data->id;
        //var_dump($data);

        if ($data->nazev) {
            $table = self::getTableName();
            $sql = "UPDATE ${table} SET nazev=(:nazev) WHERE id=${idDruh}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':nazev', $data->nazev);
            $statement->execute();
        }
        if ($data->uri) {
            $sql = "UPDATE ${table} SET uri=(:uri) WHERE id=${idDruh}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':uri', $data->uri);
            $statement->execute();
        }
        Connection::pdo()->commit();
    }

    static function create($data) {
        $table = self::getTableName();
        $sql = "INSERT INTO ${table}(nazev, uri) 
	    VALUES (:nazev, :uri)";
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute(array(
            ':nazev' => $data->nazev,
            ':uri' => $data->uri
        ));
        return Connection::pdo()->lastInsertId();
    }

    static function createDeep($data) {
        return self::create($data);
    }
}