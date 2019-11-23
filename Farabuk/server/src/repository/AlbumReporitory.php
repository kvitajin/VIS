<?php
require_once "src/data/Album.php";
require_once "src/data/Foto.php";
use Connection\Connection;

class AlbumReporitory extends Repository {

    static function getTableName() {
        return "album";
    }

    static function readAllDeep($lim) {
        $tmpAlbums=parent::readAll($lim);
        foreach ($tmpAlbums as $album){
            $album->ckIdObec=ObecRepository::readDeep($album->id);
            $album->foto= FotoRepository::readAllAlbum($album->id);
        }
        return $tmpAlbums;
    }

    static function readAllRearDeep($lim, $deep) {
        $tmpAlbums=parent::readAll($lim);
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
        $tmpAlbum=parent::read($id);
        $tmpAlbum->ckIdoObec=ObecRepository::readDeep($id);
        $tmpAlbum->foto=FotoRepository::readAllAlbum($id);
        return $tmpAlbum;
    }

    static function readRearDeep($id, $deep) {
        if ($deep){
            return ObecRepository::readRearDeep($id, --$deep);
        }
        else{
            return ObecRepository::read($id);
        }
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
            ':viditelna'=>$data->viditelna,
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
            ':viditelna'=>$data->viditelna,
            ':ck_id_obec'=>$data->ckIdObec
        ));
        $idAlbum= Connection::pdo()->lastInsertId();
        foreach ($data->foto as $fotka){
            $fotka->ckIdAlbum=$idAlbum;
            FotoRepository::create($fotka);
        }
    return $idAlbum;

    }
}