<?php
require_once __DIR__ . "/../repository/UzivatelRepository.php";
require_once __DIR__ . "/../repository/SkupinaUzivatelRepository.php";
require_once __DIR__ . "/../repository/SkupinaRepository.php";


use PHPUnit\Framework\TestCase;

class UzivatelRepositoryTest extends TestCase {

    public function testCreate() {
        $tmp= new Uzivatel();
        $tmp->nick="Tvoje Mama";
        $tmp->heslo= "qwerty";
        $tmp->hesloZnova= "qwerty";
        $tmp->email="nasrat@mail.con";
        $tmp->datumNarozeni= date('d.m.Y', strtotime('7.8.1999'));
        $tmp->ban= 1;
        $tmp->ckIdObec=1;
        $this->assertTrue(UzivatelRepository::create($tmp)>0);
    }

    public function testUpdate() {

    }

    public function testReadDeep() {
        var_dump(UzivatelRepository::readDeep(1));
    }

    public function testReadAllRearDeep() {

    }

    public function testReadAllDeep() {

    }

    public function testRead() {
        var_dump(UzivatelRepository::read(1));
    }

    public function testReadRearDeep() {

    }

    public function testCreateDeep() {
    }
}
