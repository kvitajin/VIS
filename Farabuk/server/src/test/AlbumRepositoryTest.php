<?php
require_once __DIR__ ."/../repository/AlbumRepository.php";

use PHPUnit\Framework\TestCase;

class AlbumRepositoryTest extends TestCase {

    public function testReadAllRearDeep() {
//        var_dump(AlbumRepository::readAllRearDeep(5, 2));
        $this->assertTrue(AlbumRepository::readAllRearDeep(1)!= null);

    }

    public function testReadDeep() {
        //var_dump(AlbumRepository::readDeep(5));
        $this->assertTrue(AlbumRepository::readDeep(5)!= null);
    }

    public function testReadAll() {
//        var_dump(AlbumRepository::readAll());
        $this->assertTrue(AlbumRepository::readAll(2)!= null);

    }

    public function testCreate() {
        $tmp= new Album();
        $tmp->nazev= "To hell and back";
        $tmp->jeUvodni=0;
        $tmp->ckIdObec=1;
        $tmp->viditelne=1;
        $this->assertTrue(AlbumRepository::create($tmp)>0);
    }

    public function testReadAllDeep() {
        //var_dump(AlbumRepository::readAllDeep());
        $this->assertTrue(AlbumRepository::readAllDeep()!=null);
    }

    public function testCreateDeep() {
        $tmp= new Album();
        $tmp->nazev= "To VSB and back";
        $tmp->jeUvodni=0;
        $tmp->ckIdObec=1;
        $tmp->viditelne=1;

        $fotka= new Foto();
        $fotka->datum= date('H:i:s d.m.Y');
        $fotka->nazevSouboru=sha1("shit");
        $fotka->viditelna=1;
        $fotka->sirka=255;
        array_push($tmp->foto, $fotka);
        $this->assertTrue(AlbumRepository::createDeep($tmp)>0);
    }

    public function testUpdate() {

    }

    public function testDelete() {

    }

    public function testReadRearDeep() {
//        var_dump(AlbumRepository::readRearDeep(1, 2));
        $this->assertTrue(AlbumRepository::readRearDeep(1,2)!=null);

    }

    public function testRead() {
        //var_dump(AlbumRepository::read(1));
        $this->assertTrue(AlbumRepository::read(1)!=null);
    }

    public function testReadAllObec(){
//        var_dump(AlbumRepository::readAllObec(1));
        $this->assertTrue(AlbumRepository::readAllObec(2)!=null);

    }
}
