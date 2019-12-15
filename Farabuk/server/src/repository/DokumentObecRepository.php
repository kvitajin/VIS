<?php
require_once __DIR__ . "/../../../server/src/data/Dokument.php";
require_once __DIR__ . "/../../../server/src/data/Obec.php";
require_once __DIR__ . "/../../../server/src/data/DokumentObec.php";

use Connection\Connection;



class DokumentObecRepository extends RelRepository {

    static function getTableName() {
        return "dokument_obec";
    }

    static function read($id, $fromSide) {
        if($fromSide== "dokument"){
            $sql = "SELECT * FROM " . static::getTableName() . " WHERE ck_id_dokument=" . $id;
        }
        elseif ($fromSide=="obec"){
            $sql = "SELECT * FROM " . static::getTableName() . " WHERE ck_id_obec=" . $id;
        }
        else{
            echo "o kurwa dokumentFotoRep";
            return 0;
        }
        $statement = Connection::pdo()->prepare($sql);
        $i = 0;
        $statement->execute();

        while ($records[$i] = $statement->fetch(PDO::FETCH_ASSOC)) {
            $i++;
        }
        //var_dump($records);
        $data=array();
        $values=array();

        if ($fromSide=="dokument"){
            foreach ($records as $obj){
                array_push($values, intval($obj["ck_id_obec"]));
            }
            foreach ($values as $idcko){
                $sql = "SELECT * FROM obec WHERE id=" . $idcko;
                $statement = Connection::pdo()->prepare($sql);
                $statement->execute();
                $tmp=$statement->fetch(PDO::FETCH_ASSOC);
                $tmpObec= new Obec();
                $tmpObec->id=intval($tmp["id"]);
                $tmpObec->erb=$tmp["erb"];
                $tmpObec->nazev=$tmp["nazev"];
                $tmpObec->uri=$tmp["uri"];
                $tmpObec->viditelna=$tmp["viditelna"];
                array_push($data, $tmpObec);
            }
        }
        elseif ($fromSide=="obec"){
            foreach ($records as $obj){
                array_push($values, intval($obj["ck_id_dokument"]));
            }
            //var_dump($values);
            foreach ($values as $idcko){
                $sql = "SELECT * FROM dokument WHERE id=" . $idcko;
                $statement = Connection::pdo()->prepare($sql);
                $statement->execute();
                $tmp=$statement->fetch(PDO::FETCH_ASSOC);
                $tmpFoto= new Dokumment();
                $tmpFoto->id= intval($tmp["id"]);
                $tmpFoto->datum= $tmp["datum"];
                $tmpFoto->sirka= intval($tmp["sirka"]);
                $tmpFoto->nazevSouboru= $tmp["nazev_souboru"];
                $tmpFoto->popis= $tmp["viditelna"];
                $tmpFoto->ckIdAlbum= $tmp["ck_id_album"];
                array_push($data,$tmpFoto );
            }
        }

        return $data;
        //TODO: zkusit

    }

    static function create($idDokument, $idObec) {
        $table = self::getTableName();
        $sql = "INSERT INTO ${table}(ck_id_dokument, ck_id_obec) 
	    VALUES (".$idDokument ." , ". $idObec .")";
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        return Connection::pdo()->lastInsertId();
    }

    static function delete($id, $fromSide) {
        // TODO: Implement delete() method.
    }
}