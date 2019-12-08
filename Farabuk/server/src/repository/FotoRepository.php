<?php
require_once __DIR__ ."/../data/Foto.php";
require_once __DIR__ ."/../repository/AlbumRepository.php";

use Connection\Connection;


class FotoRepository extends Repository {

    static function getTableName() {
        return "foto";
    }
    static function arr2Obj($data){
        $out= new Foto();
        $out->id=intval($data["id"]);
        $out->datum=$data["datum"];
        $out->sirka=intval($data["sirka"]);
        $out->nazevSouboru=$data["nazev_souboru"];
        $out->viditelna=intval($data["viditelna"]);
        $out->ckIdAlbum=intval($data["ck_id_album"]);
        return $out;
    }

    static function readAllDeep($idAlbum) {
        $sql = "SELECT * FROM " . static::getTableName() . " WHERE ck_id_album=" . $idAlbum;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        $data=array();
        while ($tmp = $statement->fetch(PDO::FETCH_ASSOC)) {
            $item= self::arr2Obj($tmp);
            $item->ckIdAlbum=AlbumRepository::readDeep($item->ckIdAlbum);
            array_push($data, $item);
        }
        return $data;
    }

    static function readAllRearDeep($idAlbum, $deep) {
        $tmp= self::readAllAlbum($idAlbum);
        if (--$deep){
            foreach ($tmp as $album){
                $album->ckIdAlbum=AlbumRepository::readRearDeep($album->ckIdAlbum, $deep);
            }
        }
        return $tmp;
    }

    static function readDeep($id) {
        $tmpFoto= self::read($id);
        $tmpFoto->ckIdAlbum=AlbumRepository::readDeep($tmpFoto->ckIdAlbum);
        return $tmpFoto;
    }

    static function readRearDeep($id, $deep) {
        $tmpFoto=self::read($id);
        if (--$deep){
            $tmpFoto->ickIdAlbum=AlbumRepository::readRearDeep($tmpFoto->id, $deep);
        }
        else{
            $tmpFoto->ickIdAlbum=AlbumRepository::read($tmpFoto->id);
        }
        return $tmpFoto;
    }

    static function update($data) {
        Connection::pdo()->beginTransaction();
        $table = self::getTableName();
        $idFoto = $data->id;
        //var_dump($data);
        if ($data->sirka) {
            $sql = "UPDATE ${table} SET sirka=(:sirka) WHERE id=${idFoto}";
            //var_dump($sql);
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':sirka', $data->sirka);
            $statement->execute();
        }
        if ($data->nazevSouboru) {
            $table = self::getTableName();
            $sql = "UPDATE ${table} SET nazev_souboru=(:nazev_souboru) WHERE id=${idFoto}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':nazev_souboru', $data->nazev_souboru);
            $statement->execute();
        }
        if ($data->popis) {
            $sql = "UPDATE ${table} SET popis=(:popis) WHERE id=${idFoto}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':popis', $data->popis);
            $statement->execute();
        }
        if ($data->viditelna!==null) {
            $sql = "UPDATE ${table} SET viditelna=(:viditelna) WHERE id=${idFoto}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':viditelna', $data->viditelna);
            $statement->execute();
        }
        if ($data->ckIdAlbum) {
            $sql = "UPDATE ${table} SET ck_id_album=(:ck_id_album) WHERE id=${idFoto}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':ck_id_album', $data->ckIdAlbum);
            $statement->execute();
        }
        Connection::pdo()->commit();
        return true;

    }

    static function create($data) {
        $table = self::getTableName();
        $sql = "INSERT INTO ${table}(datum, sirka, nazev_souboru, popis, viditelna, ck_id_album) 
	    VALUES (:datum, :sirka, :nazev_souboru, :popis, :viditelna, :ck_id_album)";
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute(array(
            ':datum' => $data->datum,
            ':sirka' => $data->sirka,
            ':nazev_souboru' => $data->nazevSouboru,
            ':popis'=> $data->popis,
            ':viditelna'=> $data->viditelna,
            ':ck_id_album' => $data->ckIdAlbum
        ));
        return Connection::pdo()->lastInsertId();
    }

    static function createDeep($data) {
        return AlbumRepository::createDeep($data);
    }

    static function readAllAlbum($id){
        $sql = "SELECT * FROM " . static::getTableName() . " WHERE ck_id_album=" . $id;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        $data=array();
        while ($tmp = $statement->fetch(PDO::FETCH_ASSOC)) {
            array_push($data, self::arr2Obj($tmp));
        }
        return $data;
    }

    static function read($id) {
        return self::arr2Obj(parent::read($id));
    }
    static function delete($id) {
        $tmp = new Foto();
        $tmp->id=$id;
        $tmp->viditelna=0;
        return self::update($tmp);
    }

    public static function readAll($lim = 99) {
        $tmp = parent::readAll($lim);
        $data = array();
        foreach ($tmp as $item) {
            array_push($data, self::arr2Obj($item));
        }
        return $data;
    }


}