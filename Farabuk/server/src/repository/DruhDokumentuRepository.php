<?php
require_once __DIR__ . "/../data/DruhDokumentu.php";
require_once __DIR__ . "/../repository/DokumentRepository.php";

use Connection\Connection;

//TODO dodat do deepu vsechny dokumenty

class DruhDokumentuRepository extends Repository {
    static function getTableName(){
        return "druh_dokumentu";
    }

    static function readAllDeep($lim) {
        return self::readAll($lim);
    }

    static function readAllRearDeep($lim, $deep) {
        return self::readAll($lim);
    }

    static function readDeep($id) {
        return self::read($id);
    }

    static function readRearDeep($id, $deep) {
        return self::read($id);
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
        return true;
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

    static function arr2Obj($data){
        $tmp= new DruhDokumentu();
        $tmp->id=$data["id"];
        $tmp->nazev=$data["nazev"];
        $tmp->uri=$data["uri"];
        return $tmp;

    }
    static function read($id) {
        $tmp=parent::read($id);
        return self::arr2Obj($tmp);
    }

    static function readAll($lim = 99) {
        $tmpData= parent::readAll($lim);
        $data= array();
        foreach ($tmpData as $item) {
            array_push($data, self::arr2Obj($item));
        }
        return $data;
    }


}