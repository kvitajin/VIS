<?php

require_once __DIR__ . "/../repository/Repository.php";
require_once __DIR__ . "/../data/Uzivatel.php";
require_once __DIR__ . "/../repository/SkupinaRepository.php";
require_once __DIR__ . "/../repository/SkupinaUzivatelRepository.php";
require_once __DIR__ . "/../repository/ObecRepository.php";

use Connection\Connection;

class UzivatelRepository extends Repository {
    static function getTableName() {
        return "uzivatel";
    }
    static function read($email) {
        $sql = "SELECT id, nick, heslo, email, datum_narozeni, ban, ck_id_obec FROM " . static::getTableName() . " WHERE email=(:email)";
        $statement = Connection::pdo()->prepare($sql);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        //return $record;
        $uzivatel= new Uzivatel();
        $uzivatel->id=intval($record["id"]);
        $uzivatel->nick=$record["nick"];
        $uzivatel->heslo=$record["heslo"];
        $uzivatel->email=$record["email"];
        $uzivatel->datumNarozeni=$record["datum_narozeni"];
        $uzivatel->ban= intval($record["ban"]);
        $uzivatel->ckIdObec=intval($record["ck_id_obec"]);

        $uzivatel->skupina=SkupinaUzivatelRepository::read($uzivatel->id, self::getTableName());

        return $uzivatel;
    }

    static function readAllDeep($lim) {
        //TODO: nejake hovna
    }

    static function readAllRearDeep($lim, $deep) {
        // TODO: Implement readAllRearDeep() method.
    }

    static function readDeep($id) {
        $tmp= self::read($id);
        $tmp->ckIdObec= ObecRepository::readDeep($tmp->ckIdObec);
        foreach ($tmp->skupina as $item){
            $item=SkupinaUzivatelRepository::read($item->id, self::getTableName());
        }
        return $tmp;
    }

    static function readRearDeep($id, $deep) {
        // TODO: Implement readRearDeep() method.
    }

    static function update($data) {
        // TODO: Implement update() method.
    }

    static function create($data) { //TODO overeni unikatnosti emailu
        //var_dump($data);
        if (!self::userExists($data->email)) {
            if ($data->heslo === $data->hesloZnova) {
                if ($data->datumNarozeni) {           //TODO overeni veku
                    $data->heslo = password_hash($data->heslo, PASSWORD_DEFAULT);
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
                header("Location: /error");
            }
            header("Location: /error");
        }
        return null;
    }

    static function createDeep($data) {
        // TODO: Implement createDeep() method.
    }

    static function arr2Obj($data){
        $tmp = new Uzivatel();
        $tmp->id=intval($data["id"]);
        $tmp->nick=$data["nick"];
        $tmp->datumNarozeni=$data["datum_narozeni"];
        $tmp->ban= intval($data["ban"]);
        $tmp->ckIdObec=intval($data["ck_id_obec"]);

        return $tmp;
    }

    static function userExists($email){
        $sql = "SELECT count(*) FROM " . static::getTableName() . " WHERE email= (:email)";
        $statement = Connection::pdo()->prepare($sql);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        //return $record;
        //var_dump($record);
        if (intval($record['count(*)'])){
            return true;
        }
        return false;
    }

    static function getUserPasswd($email){
        $sql = "SELECT heslo FROM " . static::getTableName() . " WHERE email= :email";
        $statement = Connection::pdo()->prepare($sql);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        //return $record;
        return $record["heslo"];
    }



}