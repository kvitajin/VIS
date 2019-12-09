<?php
require_once __DIR__ . "/../repository/DruhDokumentuRepository.php";

use PHPUnit\Framework\TestCase;

class DruhDokumentuRepositoryTest extends TestCase {

    public function testRead() {
//        var_dump(DruhDokumentuRepository::read(1));
        $this->assertTrue(DruhDokumentuRepository::read(1)!==null);

    }

    public function testDelete() {
        $this->assertTrue(DruhDokumentuRepository::delete(6)!==null);

    }

    public function testReadAll() {
//        var_dump(DruhDokumentuRepository::readAll());
        $this->assertTrue(DruhDokumentuRepository::readAll(1)!==null);

    }

    public function testReadRearDeep() {
//        var_dump(DruhDokumentuRepository::readRearDeep(1, 5));
        $this->assertTrue(DruhDokumentuRepository::readRearDeep(1, 5)!==null);
    }

    public function testReadAllRearDeep() {
//        var_dump(DruhDokumentuRepository::readAllRearDeep(99, 5));
        $this->assertTrue(DruhDokumentuRepository::readAllRearDeep(99, 5)!==null);
    }

    public function testReadDeep() {
//      var_dump(DruhDokumentuRepository::readDeep(1));
        $this->assertTrue(DruhDokumentuRepository::readDeep(1)!==null);
    }

    public function testUpdate() {
        $tmp= new DruhDokumentu();
        $tmp->id=5;
        $tmp->uri="cosi";
        $this->assertTrue(DruhDokumentuRepository::update($tmp)>0);
    }

    public function testCreate() {
        $tmp= new DruhDokumentu();
        $tmp->nazev="Ekonomická rada";
        $tmp->uri="ekonomicka";
        $this->assertTrue(DruhDokumentuRepository::create($tmp)>0);
    }

    public function testReadAllDeep() {
//              var_dump(DruhDokumentuRepository::readAllDeep(5));
        $this->assertTrue(DruhDokumentuRepository::readAllDeep(5)!==null);
    }

    public function testCreateDeep() {
        $tmp= new DruhDokumentu();
        $tmp->nazev="Hlazení poníků";
        $tmp->uri="hlazeni_poniku";
        $this->assertTrue(DruhDokumentuRepository::create($tmp)>0);
    }
}
