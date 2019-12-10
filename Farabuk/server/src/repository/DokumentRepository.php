<?php
require_once __DIR__ . "/../data/Dokument.php";
require_once __DIR__ . "/../repository/DruhDokumentuRepository.php";
require_once __DIR__ . "/../repository/KategorieDokumentuRepository.php";

use Connection\Connection;


class DokumentRepository extends Repository {

    static function getTableName() {
        return "dokument";
    }

    static function readAllDeep($idObec, $lim=99) {
        $sql = "SELECT * FROM " . static::getTableName() . " JOIN dokument_obec on ". static::getTableName(). ".id=dokument_obec.ck_id_dokument WHERE dokument_obec.ck_id_obec=" . $idObec;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        $data=array();
        while ($tmp = $statement->fetch(PDO::FETCH_ASSOC)) {
            $item= self::arry2Obj($tmp);
            $item->ckIdDruhDokumentu=DruhDokumentuRepository::readDeep($item->ckIdDruhDokumentu);
            $item->ckIdKategorieDokumentu=KategorieDokumentuRepository::readDeep($item->ckIdKategorieDokumentu);
            array_push($data, $item);
        }
        return $data;
    }

    static function readAllRearDeep($deep, $lim=99) {
        $tmp = self::readAll($lim);
        if (--$deep){
            foreach ($tmp as $item) {
                $item->ckIdDruhDokumentu=DruhDokumentuRepository::readRearDeep($item->ckIdDruhDokumentu, $deep);
                $item->ckIdKategorieDokumentu=KategorieDokumentuRepository::readRearDeep($item->ckIdKategorieDokumentu, $deep);
            }
        }
        return $tmp;
    }

    static function readDeep($id) {
        $tmpDokument= self::arry2Obj(parent::read($id));
        $tmpDokument->ckIdDruhDokumentu=DruhDokumentuRepository::readDeep($tmpDokument->ckIdDruhDokumentu);
        $tmpDokument->ckIdKategorieDokumentu=KategorieDokumentuRepository::readDeep($tmpDokument->ckIdKategorieDokumentu);
        return $tmpDokument;
    }

    static function readRearDeep($id, $deep) {
        $tmpDokument= self::arry2Obj(parent::read($id));
        if (--$deep){
            $tmpDokument->ckIdDruhDokumentu=DruhDokumentuRepository::readRearDeep($tmpDokument->ckIdDruhDokumentu, $deep);
            $tmpDokument->ckIdKategorieDokumentu=DruhDokumentuRepository::readRearDeep($tmpDokument->ckIdKategorieDokumentu, $id);
        }
        else{
            $tmpDokument->ckIdDruhDokumentu=DruhDokumentuRepository::readRearDeep($tmpDokument->ckIdDruhDokumentu, $deep);
            $tmpDokument->ckIdKategorieDokumentu=DruhDokumentuRepository::readRearDeep($tmpDokument->ckIdKategorieDokumentu, $id);
        }
        return $tmpDokument;

    }

    static function update($data) {
        Connection::pdo()->beginTransaction();
        $table = self::getTableName();
        $idDokument = $data->id;
        //var_dump($data);
        if ($data->nadpis) {
            $sql = "UPDATE ${table} SET nadpis=(:nadpis) WHERE id=${idDokument}";
            //var_dump($sql);
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':nadpis', $data->nadpis);
            $statement->execute();
        }
        if ($data->podnadpis) {
            $sql = "UPDATE ${table} SET podnadpis=(:podnadpis) WHERE id=${idDokument}";
            //var_dump($sql);
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':podnadpis', $data->podnadpis);
            $statement->execute();
        }
        if ($data->uri) {
            $table = self::getTableName();
            $sql = "UPDATE ${table} SET uri=(:uri) WHERE id=${idDokument}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':uri', $data->uri);
            $statement->execute();
        }
        if ($data->obsah) {
            $sql = "UPDATE ${table} SET obsah=(:obsah) WHERE id=${idDokument}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':obsah', $data->obsah);
            $statement->execute();
        }
        if ($data->datum) {
            $sql = "UPDATE ${table} SET obsah=(:datum) WHERE id=${idDokument}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':datum', $data->datum);
            $statement->execute();
        }
        if ($data->datumVyveseni) {
            $sql = "UPDATE ${table} SET datum_vyveseni=(:datum_vyveseni) WHERE id=${idDokument}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':datum_vyveseni', $data->datumVyveseni);
            $statement->execute();
        }
        if ($data->datumStazeni) {
            $sql = "UPDATE ${table} SET datum_stazeni=(:datum_stazeni) WHERE id=${idDokument}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':datum_stazeni', $data->datumStazeni);
            $statement->execute();
        }
        if ($data->obrazek) {
            $sql = "UPDATE ${table} SET obrazek=(:obrazek) WHERE id=${idDokument}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':obrazek', $data->obrazek);
            $statement->execute();
        }

        if ($data->ckIdDruhDokumentu) {
            $sql = "UPDATE ${table} SET ck_id_druh_dokumentu=(:druh) WHERE id=${idDokument}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':druh', $data->ckIdDruhDokumentu);
            $statement->execute();
        }
        if ($data->ckIdKategorieDokumentu) {
            $sql = "UPDATE ${table} SET ck_id_kategorie_dokumentu=(:kategorie) WHERE id=${idDokument}";
            $statement = Connection::pdo()->prepare($sql);
            $statement->bindValue(':kategorie', $data->ckIdKategorieDokumentu);
            $statement->execute();
        }
        Connection::pdo()->commit();
        return true;
    }

    static function create($data) {
        $table = self::getTableName();
        $sql = "INSERT INTO ${table}(nadpis, podnadpis, uri, obsah, datum, datum_vyveseni, datum_stazeni, obrazek, ck_id_druh_dokumentu, ck_id_kategorie_dokumentu) 
	    VALUES (:nadpis, :podnadpis, :uri, :obsah, :datum, :vyveseni, :stazeni, :obrazek, :ck_id_druh_dokumentu, :ck_id_kategorie_dokumentu)";
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute(array(
            ':nadpis' => $data->nadpis,
            ':podnadpis' => $data->podnadpis,
            ':uri' => $data->uri,
            ':obsah' => $data->obsah,
            ':datum' => $data->datum,
            ':vyveseni' => $data->datumVyveseni,
            ':stazeni' => $data->datumStazeni,
            ':obrazek'=> $data->obrazek,
            ':ck_id_druh_dokumentu'=> $data->ckIdDruhDokumentu,
            ':ck_id_kategorie_dokumentu' => $data->ckIdKategorieDokumentu
        ));
        return Connection::pdo()->lastInsertId();    }

    static function createDeep($data) {
        $data->ckIdDruhDokumentu= DruhDokumentuRepository::createDeep($data->ckIdDruhDokumentu);
        $data->ckIdKategorieDokumentu= KategorieDokumentuRepository::createDeep($data->ckIdKategorieDokumentu);
        return self::create($data);

    }

    static function arry2Obj($dokument){
        $tmpDokument= new Dokument();
        $tmpDokument->id=intval($dokument["id"]);
        $tmpDokument->nadpis=$dokument["nadpis"];
        $tmpDokument->podnadpis=$dokument["podnadpis"]; //todo v db chybi podpadpis
        $tmpDokument->uri=$dokument["uri"];
        $tmpDokument->obsah=$dokument["obsah"];
        $tmpDokument->datumVyveseni=$dokument["datum_vyveseni"];
        $tmpDokument->datumStazeni=$dokument["datum_stazeni"];
        $tmpDokument->datum=$dokument["datum"];
        $tmpDokument->obrazek=$dokument["obrazek"];
        $tmpDokument->ckIdDruhDokumentu=intval($dokument["ck_id_druh_dokumentu"]);
        $tmpDokument->ckIdKategorieDokumentu=intval($dokument["ck_id_kategorie_dokumentu"]);
        return $tmpDokument;
    }

    static function readAllDruh($id, $lim=99){
        $sql = "SELECT * FROM " . static::getTableName() ." WHERE ck_id_druh_dokumentu= ". $id . " LIMIT " . $lim ;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        $data= array();
        while ($tmp = $statement->fetch(PDO::FETCH_ASSOC)) {
            array_push($data, self::arry2Obj($tmp));
        }
        return $data;
    }

    public static function read($id) {
        $tmp= parent::read($id);
        return self::arry2Obj($tmp);
    }

    static function readAllKategorie($id, $lim=99){
        $sql = "SELECT * FROM " . static::getTableName() ." WHERE ck_id_kategorie_dokumentu= ". $id . " LIMIT " . $lim ;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        $data= array();
        while ($tmp = $statement->fetch(PDO::FETCH_ASSOC)) {
            array_push($data, self::arry2Obj($tmp));
        }
        return $data;
    }

    static function readAllKategorieDruh($idKategorie, $idDruh, $lim=99){
        $sql = "SELECT * FROM " . static::getTableName() ." WHERE ck_id_druh_dokumentu= ". $idDruh . " AND ck_id_kategorie_dokumentu= ". $idKategorie. " LIMIT " . $lim ;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        $data= array();
        while ($tmp = $statement->fetch(PDO::FETCH_ASSOC)) {
            array_push($data, self::arry2Obj($tmp));
        }
        return $data;
    }


    public static function readAll($lim = 99) {
        $tmp = parent::readAll($lim);
        $data = array();
        foreach ($tmp as $item) {
            array_push($data, self::arry2Obj($item));
        }
        return $data;
    }


}