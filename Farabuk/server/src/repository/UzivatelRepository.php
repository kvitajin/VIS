<?php

require_once "Repository.php";
require_once "src/data/Uzivatel.php";
require_once "SkupinaRepository.php";
use Connection\Connection;

class UzivatelRepository extends Repository {
    static function getTableName() {
        return "uzivatel";
    }
    static function read($id) {
        $sql = "SELECT * FROM " . static::getTableName() . " WHERE id=" . $id;
        $statement = Connection::pdo()->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        //return $record;
        $uzivatel= new Uzivatel();
        $uzivatel->id=intval($record["id"]);
        $uzivatel->nick=$record["nick"];
        $uzivatel->heslo=$record["heslo"];
        $uzivatel->email=$record["email"];
        $uzivatel->datumNarozeni=$record["datim_narozeni"];
        $uzivatel->ban= intval($record[ban]);
        $uzivatel->ckIdObec=intval($record["ck_id_obec"]);
//        var_dump($record);
//        echo "\n\n";
        //var_dump($uzivatel);
        $uzivatel->skupina=SkupinaUzivatelRepository::read($uzivatel->id, self::getTableName());
        return $uzivatel;
    }

    static function readAllDeep($lim) {
        // TODO: Implement readAllDeep() method.
    }

    static function readAllRearDeep($lim, $deep) {
        // TODO: Implement readAllRearDeep() method.
    }

    static function readDeep($id) {
        $tmp= self::read($id);
        $tmp->likeDokument= a;      //todo tady dodelat, ale prve vsechny vazebni tabulky
    }

    static function readRearDeep($id, $deep) {
        // TODO: Implement readRearDeep() method.
    }

    static function update($data) {
        // TODO: Implement update() method.
    }

    static function create($data) { //TODO overeni unikatnosti emailu
        //var_dump($data);
        if ($data->heslo===$data->hesloZnova){
            if($data->datumNarozeni) {           //TODO overeni veku
                $data->heslo= password_hash($data->heslo, PASSWORD_DEFAULT);
                $table = self::getTableName();
                $sql = "INSERT INTO ${table}(nick, heslo, email, datum_narozeni, ban, ck_id_obec) 
	    VALUES (:nick, :heslo, :email, :datum_narozeni, :ban, :ck_id_obec)";
                $statement = Connection::pdo()->prepare($sql);
                $statement->execute(array(
                    ':nick' => $data->nick,
                    ':heslo' => $data->heslo,
                    ':email' => $data->email,
                    ':datum_narozeni' => $data->datumNarozeni,
                    ':ban' => $data->ban,
                    ':ck_id_obec' => $data->ckIdObec
                ));
                return Connection::pdo()->lastInsertId();
            }
        }








    }

    static function createDeep($data) {
        // TODO: Implement createDeep() method.
    }

}