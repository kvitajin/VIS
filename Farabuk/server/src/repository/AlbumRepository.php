<?php
require_once __DIR__ ."/../data/Album.php";
require_once __DIR__ ."/../repository/FotoRepository.php";
require_once __DIR__ ."/../repository/ObecRepository.php";

use Connection\Connection;

class AlbumRepository extends Repository {

    static function getTableName() {
        return "album";
    }

    static function readAllDeep($lim=99) {
        $tmpAlbums=parent::readAll($lim);
        $data=array();
        foreach ($tmpAlbums as $item){
            $tmp=new Album();
            $tmp->id= intval($item['id']);
            $tmp->nazev=$item["nazev"];
            $tmp->jeUvodni= intval($item["je_uvodni"]);
            $tmp->viditelne= intval($item["viditelne"]);
            $tmp->ckIdObec= intval($item["ck_id_obec"]);
            $tmp->ckIdObec=ObecRepository::readDeep($tmp->id);
            $tmp->foto=FotoRepository::readAllAlbum($tmp->id);
            array_push($data, $tmp);
        }
        return $data;
    }
    static function readAllRearDeep($deep, $lim=99) {
        $tmpAlbums=self::readAll($lim);


        if (--$deep){
            foreach ($tmpAlbums as $album){
                $album->ckIdObec=ObecRepository::readRearDeep($album->ckIdObec, $deep);
            }
        }
        else{
            foreach ($tmpAlbums as $album) {
                $album->ckIdObec=ObecRepository::read($album->ckIdObec);
            }
        }
        return $tmpAlbums;
    }

    static function readDeep($id) {
        $tmpAlbum=self::read($id);
        $tmpAlbum->ckIdoObec=ObecRepository::readDeep($id);
        $tmpAlbum->foto=FotoRepository::readAllAlbum($id);
        return $tmpAlbum;
    }

    static function readRearDeep($id, $deep) {      //TODO co to kurva je?
        $tmp= self::read($id);
        if (--$deep){
            $tmp->ckIdObec= ObecRepository::readRearDeep($id, --$deep);
        }
        return $tmp;
    }

    static function update($data) {
        Connection::pdo()->beginTransaction();
        $table = self::getTableName();
        $idAlbum = $data->id;
        //var_dump($data);
        if ($data->nazev) {
            $table = self::getTableName();
            $sql = "UPDATE ${table} SET nazev=(:nazev) WHERE id=${idAlbum}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':nazev', $data->nazev);
            $statement->execute();
        }
        if ($data->jeUvodni) {
            $sql = "UPDATE ${table} SET je_uvodni=(:jeUvodni) WHERE id=${idAlbum}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':jeUvodni', $data->jeUvodni);
            $statement->execute();
        }
        if ($data->viditelna) {
            $sql = "UPDATE ${table} SET viditelne=(:viditelne) WHERE id=${idAlbum}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':viditelne', $data->viditelne);
            $statement->execute();
        }
        if ($data->ckIdObec) {
            $sql = "UPDATE ${table} SET ck_id_obec=(:ckIdObec) WHERE id=${idAlbum}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':ckIdObec', $data->ckIdObec);
            $statement->execute();
        }
        Connection::pdo()->commit();
    }

    static function create($data) {
        $table = self::getTableName();
        $sql = "INSERT INTO ${table}(nazev, je_uvodni, viditelne, ck_id_obec) 
	    VALUES (:nazev, :je_uvodni, :viditelne, :ck_id_obec)";
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute(array(
            ':nazev' => $data->nazev,
            ':je_uvodni'=>$data->jeUvodni,
            ':viditelne'=>$data->viditelne,
            ':ck_id_obec'=>$data->ckIdObec
        ));
        return Connection::pdo()->lastInsertId();
    }

    static function createDeep($data) {
        $table = self::getTableName();
        $sql = "INSERT INTO ${table}(nazev, je_uvodni, viditelne, ck_id_obec) 
	    VALUES (:nazev, :je_uvodni, :viditelne, :ck_id_obec)";
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute(array(
            ':nazev' => $data->nazev,
            ':je_uvodni'=>$data->jeUvodni,
            ':viditelne'=>$data->viditelne,
            ':ck_id_obec'=>$data->ckIdObec
        ));
        $idAlbum= Connection::pdo()->lastInsertId();
        foreach ($data->foto as $fotka){
            $fotka->ckIdAlbum=$idAlbum;
            FotoRepository::create($fotka);
        }
    return $idAlbum;
    }

    static function read($id) {
        $tmp = parent::read($id);
        $data= new Album();
        $data->id= intval($tmp["id"]);
        $data->nazev=$tmp["nazev"];
        $data->jeUvodni= intval($tmp["je_uvodni"]);
        $data->viditelne= intval($tmp["viditelne"]);
        $data->ckIdObec= intval($tmp["ck_id_obec"]);
        $data->foto= null;
        return $data;
    }

    static function readAll($lim = 99) {
        $tmpData= parent::readAll($lim);
        $data= array();
        foreach ($tmpData as $item){
            $tmp= new Album();
            $tmp->id= intval($item["id"]);
            $tmp->nazev= $item["nazev"];
            $tmp->jeUvodni= $item["je_uvodni"];
            $tmp->viditelne= $item["viditelne"];
            $tmp->ckIdObec= intval($item["ck_id_obec"]);
            array_push($data, $tmp);
        }
        return $data;
    }
    static function readAllObec($id, $lim=99){
        $sql = "SELECT * FROM " . static::getTableName() ." WHERE ck_id_obec= ". $id . " LIMIT " . $lim ;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        $i = 0;
        $data= array();
        while ($records = $statement->fetch(PDO::FETCH_ASSOC)) {
            $tmp= new Album();
            $tmp->id= $records["id"];
            $tmp->nazev= $records["nazev"];
            $tmp->jeUvodni= $records["je_uvodni"];
            $tmp->viditelne= $records["viditelne"];
            $tmp->ckIdObec= $records["ck_id_obec"];
            array_push($data, $tmp);
            $i++;
        }
        return $data;
    }
}