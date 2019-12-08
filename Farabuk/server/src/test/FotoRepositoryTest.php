<?php
require_once __DIR__ . "/../repository/FotoRepository.php";


use PHPUnit\Framework\TestCase;

class FotoRepositoryTest extends TestCase {

    public function testCreateDeep() {

    }

    public function testRead() {
//        var_dump(FotoRepository::read(1));
        $this->assertTrue(FotoRepository::read(1)!==null);

    }

    public function testCreate() {
        $tmp= new Foto();
        $tmp->sirka=255;
        $tmp->nazevSouboru= sha1("pokus");
        $tmp->datum=date('H:i:s d.m.Y');
        $tmp->ckIdAlbum=1;
        $tmp->popis="asas";
        $this->assertTrue(FotoRepository::create($tmp)>0);
    }

    public function testDelete() {

    }

    public function testReadRearDeep() {
//        var_dump(FotoRepository::readRearDeep(1, 2));
        $this->assertTrue(FotoRepository::readRearDeep(1,2)!==null);

    }

    public function testReadAllAlbum() {

    }

    public function testUpdate() {

    }

    public function testReadDeep() {
        var_dump(FotoRepository::readDeep(1));
        $this->assertTrue(FotoRepository::readDeep(1)!==null);

    }

    public function testReadAllRearDeep() {

    }

    public function testReadAllDeep() {

    }

    public function testReadAll() {

    }
}
