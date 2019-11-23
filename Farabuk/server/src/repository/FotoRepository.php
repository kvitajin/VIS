<?php
require_once "src/data/Foto.php";
use Connection\Connection;

class FotoRepository extends Repository {

    static function getTableName() {
        return "foto";
    }

    static function readAllDeep($idAlbum) {
        $sql = "SELECT * FROM " . static::getTableName() . " WHERE ck_id_album=" . $idAlbum;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        $i = 0;
        while ($records[$i] = $statement->fetch(PDO::FETCH_ASSOC)) {
            $records[$i]->ckIdObec=ObecRepository::readDeep($records[$i]->ckIdObec);
            $i++;
        }
        return $records;
    }

    static function readAllRearDeep($idAlbum, $deep) {
        $sql = "SELECT * FROM " . static::getTableName() . " WHERE ck_id_album=" . $idAlbum;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        if (--$deep){
            $i = 0;
            while ($records[$i] = $statement->fetch(PDO::FETCH_ASSOC)) {
                $records[$i]->ckIdObec=ObecRepository::readRearDeep($records[$i]->ckIdObec, $deep);
                $i++;
            }
        }
        else{
            $i = 0;
            while ($records[$i] = $statement->fetch(PDO::FETCH_ASSOC)) {
                $i++;
            }
        }
        return $records;

    }

    static function readDeep($id) {
        $tmpFoto=parent::read($id);
        $tmpFoto->ckIdAlbum=AlbumReporitory::readDeep($tmpFoto->ckIdAlbum);
        return $tmpFoto;
    }

    static function readRearDeep($id, $deep) {
        $tmpFoto=parent::read($id);
        if (--$deep){
            $tmpFoto->ickIdAlbum=AlbumReporitory::readRearDeep($tmpFoto->id, $deep);
        }
        else{
            $tmpFoto->ickIdAlbum=AlbumReporitory::read($tmpFoto->id);

        }
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
        if ($data->nazev) {
            $table = self::getTableName();
            $sql = "UPDATE ${table} SET nazev_souboru=(:nazev_souboru) WHERE id=${idFoto}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':nazev_souboru', $data->nazev_souboru);
            $statement->execute();
        }
        if ($data->uri) {
            $sql = "UPDATE ${table} SET popis=(:popis) WHERE id=${idFoto}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':popis', $data->popis);
            $statement->execute();
        }
        if ($data->viditelna) {
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

    }

    static function create($data) {
        $table = self::getTableName();
        $sql = "INSERT INTO ${table}(datum, sirka, nazev_soboru, popis, viditelna, ck_id_album) 
	    VALUES (:datum, :sirka, :nazev_souboru, :popis, :viditelna, :ck_id_album)";
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute(array(
            ':datum' => $data->datum,
            ':sirka' => $data->sirka,
            ':nazev_souboru' => $data->nazevSoubrou,
            ':popis'=> $data->popis,
            ':viditelna'=> $data->viditelna,
            ':ck_id_album' => $data->ckIdAlbum
        ));
        return Connection::pdo()->lastInsertId();
    }

    static function createDeep($data) {
        return AlbumReporitory::createDeep($data);
    }

    static function readAllAlbum($id){
        $sql = "SELECT * FROM " . static::getTableName() . " WHERE ck_id_album=" . $id;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        $i = 0;
        while ($records[$i] = $statement->fetch(PDO::FETCH_ASSOC)) {
            $i++;
        }
        return $records;
    }

}