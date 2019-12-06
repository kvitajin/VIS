<?php
require_once "src/data/Uzivatel.php";
require_once "src/data/Foto.php";
require_once "src/data/LikeFoto.php";

use Connection\Connection;

class LikeFotoRepository extends RelRepository {
    static function getTableName() {
        return "like_foto";
    }

    static function read($id, $fromSide) {
        if($fromSide== "uzivatel"){
            $sql = "SELECT * FROM " . static::getTableName() . " WHERE ck_id_uzivatel=" . $id;
        }
        elseif ($fromSide=="foto"){
            $sql = "SELECT * FROM " . static::getTableName() . " WHERE ck_id_foto=" . $id;
        }
        else{
            echo "o kurwa likeFotoRep";
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

        if ($fromSide=="foto"){
            foreach ($records as $obj){
                array_push($values, intval($obj["ck_id_uzivatel"]));
            }
            foreach ($values as $idcko){
                $sql = "SELECT * FROM uzivatel WHERE id=" . $idcko;
                $statement = Connection::pdo()->prepare($sql);
                $statement->execute();
                $tmp=$statement->fetch(PDO::FETCH_ASSOC);
                $tmpUziv= new Uzivatel();
                $tmpUziv->id=intval($tmp["id"]);
                $tmpUziv->nick=$tmp["nick"];
                $tmpUziv->heslo=$tmp["heslo"];
                $tmpUziv->email=$tmp["email"];
                $tmpUziv->datumNarozeni=$tmp["datum_narozeni"];
                $tmpUziv->ban=intval($tmp["ban"]);
                $tmpUziv->ckIdObec=intval($tmp["ck_id_obec"]);
                array_push($data, $tmpUziv);
            }
        }
        elseif ($fromSide=="uzivatel"){
            foreach ($records as $obj){
                array_push($values, intval($obj["ck_id_foto"]));
            }
            //var_dump($values);
            foreach ($values as $idcko){
                $sql = "SELECT * FROM foto WHERE id=" . $idcko;
                $statement = Connection::pdo()->prepare($sql);
                $statement->execute();
                $tmp=$statement->fetch(PDO::FETCH_ASSOC);
                $tmpFoto= new Foto();
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

    static function create($idUzivatel, $idFoto) {
        $table = self::getTableName();
        $sql = "INSERT INTO ${table}(ck_id_uzivatel, ck_id_foto) 
	    VALUES (:uziv, :foto)";
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute(array(
            ':uziv' => $idUzivatel,
            ':foto' => $idFoto
        ));
    }

    static function delete($id, $fromSide) {
        // TODO: Implement delete() method.
    }
}