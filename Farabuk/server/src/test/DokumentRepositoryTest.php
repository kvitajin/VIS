<?php
require_once __DIR__ . "/../repository/DokumentRepository.php";
require_once __DIR__ . "/../repository/DruhDokumentuRepository.php";


use PHPUnit\Framework\TestCase;

class DokumentRepositoryTest extends TestCase {

    public function testReadAllRearDeep() {

    }

    public function testCreateDeep() {

    }

    public function testReadRearDeep() {

    }

    public function testDelete() {

    }

    public function testReadAll() {

    }

    public function testCreate() {
        $tmp= new Dokument();
        $tmp->nadpis="pokusny nadpis";
        $tmp->podnadpis="zase neco tkaoveho";
        $tmp->obsah="djsnkjnjskdnsjknsj";
        $tmp->uri="pokusny_nadpis";
        $tmp->datum= date('H:i:s d.m.Y');
        $tmp->ckIdDruhDokumentu=1;
        $tmp->ckIdKategorieDokumentu=1;
        $this->assertTrue(DokumentRepository::create($tmp)>0);
    }

    public function testReadAllDeep() {

    }

    public function testRead() {
//        var_dump(DokumentRepository::read(1));
        $this->assertTrue(DokumentRepository::read(1)!==null);
    }

    public function testUpdate() {

    }

    public function testReadAllDruh() {
        var_dump(DokumentRepository::readAllDruh(1));
        $this->assertTrue(DokumentRepository::readAllDruh(1)!==null);
    }

    public function testReadDeep() {
        var_dump(DokumentRepository::readDeep(1));      //todo dodelat druh dokumentu
//        $this->assertTrue(DokumentRepository::readAllDruh(1)!==null);
    }
}
