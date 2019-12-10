<?php
require_once __DIR__ . "/../repository/KategorieDokumentuRepository.php";

use PHPUnit\Framework\TestCase;

class KategorieDokumentuRepositoryTest extends TestCase {

    public function testReadAllDeep() {
        var_dump(KategorieDokumentuRepository::readAllDeep());
        $this->assertTrue(KategorieDokumentuRepository::readAllDeep()!= null);
    }

    public function testCreate() {
        $tmp= new KategorieDokumentu();
        $tmp->nazev= "neco";
        $this->assertTrue(KategorieDokumentuRepository::create($tmp)!= null);

    }

    public function testUpdate() {
        $tmp= new KategorieDokumentu();
        $tmp->id=1;
        $tmp->nazev="chmpff";
        $this->assertTrue(KategorieDokumentuRepository::update($tmp));
    }

    public function testReadAllRearDeep() {
        var_dump(KategorieDokumentuRepository::readAllRearDeep(5));
        $this->assertTrue(KategorieDokumentuRepository::readAllRearDeep(5)!= null);
    }

    public function testDelete() {
        $this->assertTrue(KategorieDokumentuRepository::delete(2));
    }

    public function testRead() {
//        var_dump(KategorieDokumentuRepository::read(1));
        $this->assertTrue(KategorieDokumentuRepository::read(1)!==null);
    }

    public function testReadRearDeep() {
        var_dump(KategorieDokumentuRepository::readRearDeep(1, 5));
        $this->assertTrue(KategorieDokumentuRepository::readRearDeep(1, 5)!==null);
    }

    public function testReadAll() {
        var_dump(KategorieDokumentuRepository::readAll());
        $this->assertTrue(KategorieDokumentuRepository::read(1)!==null);
    }

    public function testCreateDeep() {
        $tmp= new KategorieDokumentu();
        $tmp->nazev= "deep";
        $this->assertTrue(KategorieDokumentuRepository::createDeep($tmp)!= null);
    }

    public function testReadDeep() {
        var_dump(KategorieDokumentuRepository::readDeep(1));
        $this->assertTrue(KategorieDokumentuRepository::readDeep(1)!==null);
    }
}
