<?php
require_once __DIR__ . "/../repository/FotoRepository.php";


use PHPUnit\Framework\TestCase;

class FotoRepositoryTest extends TestCase {

    public function testCreateDeep() {
        $tmp= new Album();
        $tmp->nazev= "Another album";
        $tmp->jeUvodni=0;
        $tmp->ckIdObec=5;
        $tmp->viditelne=1;

        $fotka= new Foto();
        $fotka->datum= date('H:i:s d.m.Y');
        $fotka->nazevSouboru=sha1("something");
        $fotka->viditelna=1;
        $fotka->sirka=1920;
        array_push($tmp->foto, $fotka);
        $this->assertTrue(AlbumRepository::createDeep($tmp)>0);
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
        $this->assertTrue(FotoRepository::delete(1));

    }

    public function testReadRearDeep() {
//        var_dump(FotoRepository::readRearDeep(1, 2));
        $this->assertTrue(FotoRepository::readRearDeep(1,2)!==null);

    }

    public function testReadAllAlbum() {
        var_dump(FotoRepository::readAllAlbum(4));
        $this->assertTrue(FotoRepository::readAllAlbum(1)!==null);

    }

    public function testUpdate() {
        $tmp = new Foto();
        $tmp->id=1;
        $tmp->ckIdAlbum=1;
        $this->assertTrue(FotoRepository::update($tmp)!==null);

    }

    public function testReadDeep() {
        var_dump(FotoRepository::readDeep(1));
        $this->assertTrue(FotoRepository::readDeep(1)!==null);

    }

    public function testReadAllRearDeep() {
//        var_dump(FotoRepository::readAllRearDeep(1,5));
        $this->assertTrue(FotoRepository::readAllRearDeep(1, 2)!==null);

    }

    public function testReadAllDeep() {
//        var_dump(FotoRepository::readAllDeep(1));
        $this->assertTrue(FotoRepository::readAllDeep(1)!==null);

    }

    public function testReadAll() {
//        var_dump(FotoRepository::readAll());
        $this->assertTrue(FotoRepository::readAll()!==null);
    }
}
