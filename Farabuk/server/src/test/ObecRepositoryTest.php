<?php
require_once __DIR__ . "/../repository/ObecRepository.php";

use PHPUnit\Framework\TestCase;

class ObecRepositoryTest extends TestCase {

    public function testReadRearDeep() {
        $this->assertTrue(ObecRepository::readRearDeep(1, 2) != null);

    }

    public function testReadAll() {
//        var_dump(ObecRepository::readAll());
        $this->assertTrue(ObecRepository::readAll() != null);
    }

    public function testCreateDeep() {
        $obec = new Obec();
        $obec->nazev = "Kotehule";
        $obec->uri = "kotehule";
        $obec->erb = "neco.jpg";
        $obec->viditelna = 1;
        $this->assertTrue(ObecRepository::createDeep($obec) > 0);
    }

    public function testReadDeep() {
        //var_dump(ObecRepository::readDeep(1));
        $this->assertTrue(ObecRepository::readDeep(1) != null);
    }

    public function testReadAllDeep() {
//        var_dump(ObecRepository::readAllDeep());
        $this->assertTrue(ObecRepository::readAllDeep() != null);
    }

    public function testUpdate() {
        $obec = new Obec();
        $obec->id = 1;
        $obec->nazev = "Kuncice";
        $this->assertTrue(ObecRepository::update($obec));
    }

    public function testCreate() {
        $obec = new Obec();
        $obec->nazev = "Kotehule";
        $obec->uri = "kotehule";
        $obec->erb = "neco.jpg";
        $obec->viditelna = 1;
        $this->assertTrue(ObecRepository::create($obec) > 0);
    }

    public function testRead() {
        $this->assertTrue(ObecRepository::read(1) != null);
    }

    public function testDelete() {
        $this->assertTrue(ObecRepository::delete(1));
    }

    public function testReadAllRearDeep() {
//        var_dump(ObecRepository::readAllRearDeep(2));
        $this->assertTrue(ObecRepository::readAllRearDeep(2) != null);
    }
}
