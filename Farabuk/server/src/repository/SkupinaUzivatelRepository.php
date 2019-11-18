<?php
require_once "src/data/SkupinaUzivatel.php";



class SkupinaUzivatelRepository {
    static function getTableName(){
        return "skupina_uzivatel";
    }

    static function read($id, $fromSide) {
        if ($fromSide=="skupina"){
            $sql = "SELECT * FROM " . static::getTableName() . " WHERE ck_id_skupina=" . $id;
            $statement = Connection::pdo()->prepare($sql);
        }
        elseif ($fromSide=="uzivatel"){
            $sql = "SELECT * FROM " . static::getTableName() . " WHERE ck_id_uzivatel=" . $id;
            $statement = Connection::pdo()->prepare($sql);
        }
        else{
            return 0 ;
        }
        $i = 0;
        while ($records[$i] = $statement->fetch(PDO::FETCH_ASSOC)) {
            $i++;
        }
        return $records;
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
        return Connection::pdo()->lastInsertId();
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
    }
}