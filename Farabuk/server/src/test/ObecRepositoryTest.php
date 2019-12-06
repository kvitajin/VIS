<?php
require_once __DIR__ . "/../repository/ObecRepository.php";

use PHPUnit\Framework\TestCase;
use Connection\Connection;

class ObecRepositoryTest extends TestCase {

    public function testReadRearDeep() {

    }

    public function testReadAll() {
        var_dump(ObecRepository::readAll());
    }

    public function testCreateDeep() {

    }

    public function testGetTableName() {

    }

    public function testReadDeep() {

    }

    public function testReadAllDeep() {

    }

    public function testUpdate() {

    }

    public function testCreate() {
        $obec= new \Obec();
        $obec->nazev="Kotehule";
        $obec->uri="kotehule";
        $obec->erb= "neco.jpg";
        $obec->viditelna=1;
        ObecRepository::create($obec);
    }

    public function testRead() {
        assert(ObecRepository::read(1));
    }

    public function testDelete() {

    }

    public function testReadAllRearDeep() {

    }
}
