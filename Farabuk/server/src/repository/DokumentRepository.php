<?php
require_once "src/data/Dokument.php";

use Connection\Connection;


class DokumentRepository extends Repository {

    static function getTableName() {
        return "dokument";
    }

    static function readAllDeep($lim) {
        // TODO: Implement readAllDeep() method.
    }

    static function readAllRearDeep($lim, $deep) {
        // TODO: Implement readAllRearDeep() method.
    }

    static function readDeep($id) {
        $tmpDokument= parent::read($id);
        $tmpDokument->ckIdDruhDokumentu=DruhDokumentuRepository::readDeep($tmpDokument->ckIdDruhDokumentu);
        $tmpDokument->ckIdKategorieDokumentu=DruhDokumentuRepository::readDeep($tmpDokument->ckIdKategorieDokumentu);
        return $tmpDokument;
    }

    static function readRearDeep($id, $deep) {
        $tmpDokument= parent::read($id);
        if (--$deep){
            $tmpDokument->ckIdDruhDokumentu=DruhDokumentuRepository::readRearDeep($tmpDokument->ckIdDruhDokumentu, $deep);
            $tmpDokument->ckIdKategorieDokumentu=DruhDokumentuRepository::readRearDeep($tmpDokument->ckIdKategorieDokumentu, $id);
        }
        else{
            $tmpDokument->ckIdDruhDokumentu=DruhDokumentuRepository::readRearDeep($tmpDokument->ckIdDruhDokumentu, $deep);
            $tmpDokument->ckIdKategorieDokumentu=DruhDokumentuRepository::readRearDeep($tmpDokument->ckIdKategorieDokumentu, $id);
        }

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
            $statement->bindValue(':nadpis', $data->nadpis);
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
    }

    static function create($data) {
        $table = self::getTableName();
        $sql = "INSERT INTO ${table}(nadpis, podnadpis, uri, obsah, datum, datum_vyveseni, datum_stazeni, obrazek, ck_id_druh_dokumentu, ck_id_kategorie_dokumentu) 
	    VALUES (:nadpis, :podnadpis, :uri, :obsah, :datum, :vyveseni, :stazeni, :obrazek, , :ck_id_druh_dokumentu, ck_id_kategorie_dokumentu)";
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

}