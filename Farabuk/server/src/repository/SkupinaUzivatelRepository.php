<?php
require_once __DIR__ . "/../data/SkupinaUzivatel.php";
require_once __DIR__ . "/../data/Skupina.php";
require_once __DIR__ . "/../data/Uzivatel.php";
use Connection\Connection;



class SkupinaUzivatelRepository extends RelRepository {
    static function getTableName(){
        return "skupina_uzivatel";
    }

    static function read($id, $fromSide) {
        //echo $id . " " . $fromSide . "\n";
        $sql="";
        if ($fromSide=="skupina"){
            $sql = "SELECT * FROM " . static::getTableName() . " WHERE ck_id_skupina=" . $id;
        }
        elseif ($fromSide=="uzivatel"){
            $sql = "SELECT * FROM " . static::getTableName() . " WHERE ck_id_uzivatel=" . $id;
        }
        else{
            echo "kurwa";
            return 0 ;
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

        if ($fromSide=="skupina"){
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
                array_push($values, intval($obj["ck_id_skupina"]));
            }
            //var_dump($values);
            foreach ($values as $idcko){
                $sql = "SELECT * FROM skupina WHERE id=" . $idcko;
                $statement = Connection::pdo()->prepare($sql);
                $statement->execute();
                $tmp=$statement->fetch(PDO::FETCH_ASSOC);
                $tmpSkupina= new Skupina();
                $tmpSkupina->id=intval($tmp["id"]);
                $tmpSkupina->nazev=$tmp["nazev"];
                $tmpSkupina->opravneni=intval($tmp["opravneni"]);
                array_push($data,$tmpSkupina );
            }
        }

        return $data;
        //TODO: zkusit
    }

    static function create($idUzivatel, $idSkupina) {
        $table = self::getTableName();
        $sql = "INSERT INTO ${table}(ck_id_uzivatel, ck_id_skupina) 
	    VALUES (:uziv, :skup)";
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute(array(
            ':uziv' => $idUzivatel,
            ':skup' => $idSkupina
        ));
    }

    static function delete($id, $fromSide) {
        if($fromSide=="skupina"){
            $sql = "DELETE FROM " . self::getTableName() . " WHERE ck_id_skupina=" . $id;
            $statement = Connection::pdo()->prepare($sql);
            $statement->execute();
        }
        elseif ($fromSide=="uzivatel"){
            $sql = "DELETE FROM " . self::getTableName() . " WHERE ck_id_uzivatel=" . $id;
            $statement = Connection::pdo()->prepare($sql);
            $statement->execute();
        }
        else{
            return;
        }


        //TODO  toto mozna predelat na obecny delete jednoho zaznamu
    }
}