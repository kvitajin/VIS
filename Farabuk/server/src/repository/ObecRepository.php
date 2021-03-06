<?php
require_once __DIR__ . "/Repository.php";
require_once __DIR__ . "/../data/Obec.php";
use Connection\Connection;


class ObecRepository extends Repository {
    static function getTableName() {
        return "obec";
    }
    static function readAllDeep($lim=99) {
        return self::readAll($lim);
    }
    static function readAll($lim = 99) {
        $data=array();
        $tmpCollection= parent::readAll($lim);
        foreach ( $tmpCollection as $item){
            if (!$item["nazev"]){ continue;}
            $tmp= new Obec();
            $tmp->id= intval($item["id"]);
            $tmp->nazev= $item["nazev"];
            $tmp->erb= $item["erb"];
            $tmp->uri=$item["uri"];
            $tmp->viditelna= intval($item["viditelna"]);
            array_push($data, $tmp);
        }
        return $data;    }


    static function readAllRearDeep($deep, $lim=99) {
        return parent::readAll($lim);
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
        $idObec = $data->id;

        //echo $data->viditelna;
        if ($data->erb) {
            $sql = "UPDATE ${table} SET erb=(:erb) WHERE id=${idObec}";
            //var_dump($sql);
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':name', $data->erb);
            $statement->execute();
        }
        if ($data->nazev) {
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
        if ($data->viditelna!==NULL) {
            //echo "tu";
            $sql = "UPDATE ${table} SET viditelna=(:viditelna) WHERE id=${idObec}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':viditelna', $data->viditelna);
            $statement->execute();
        }
        Connection::pdo()->commit();
        return true;
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
    static function read($id) {
        $tmp=parent::read($id);
        $obec= new Obec();
        $obec->id= intval($tmp['id']);
        $obec->erb= $tmp['erb'];
        $obec->nazev= $tmp['nazev'];
        $obec->uri= $tmp['uri'];
        $obec->viditelna= intval($tmp['viditelna']);
        return $obec;
    }
    static function readUri( $uri){
        $sql = "SELECT * FROM " . static::getTableName() . " WHERE uri=(:uri)";
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute(array(
            'uri' => $uri
        ));
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        $data=new Obec();
        $data->id=intval($record["id"]);
        $data->erb= $record['erb'];
        $data->nazev= $record['nazev'];
        $data->uri= $record['uri'];
        $data->viditelna= intval($record['viditelna']);
        return $data;
    }

    static function delete($id) {
        $tmp= new Obec();
        $tmp->id= $id;
        $tmp->viditelna= 0;
        self::update($tmp);
        return true;
    }
}