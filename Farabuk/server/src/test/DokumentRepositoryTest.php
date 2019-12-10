<?php
require_once __DIR__ . "/../repository/DokumentRepository.php";
require_once __DIR__ . "/../repository/DruhDokumentuRepository.php";


use PHPUnit\Framework\TestCase;

class DokumentRepositoryTest extends TestCase {

    public function testReadAllRearDeep() {
//        var_dump(DokumentRepository::readAllRearDeep(5));
        $this->assertTrue(DokumentRepository::readAll()!==null);
    }

    public function testCreateDeep() {
        $tmpDruh= new DruhDokumentu();
        $tmpDruh->nazev= "hlazeni poniku";
        $tmpDruh->uri="ponici";

        $tmpKategorie= new KategorieDokumentu();
        $tmpKategorie->nazev="neco";

        $tmpDokument=new Dokument();
        $tmpDokument->nadpis="fuck";
        $tmpDokument->podnadpis="this";
        $tmpDokument->uri="shit";
        $tmpDokument->obsah="sdnsjknsdjs";
        $tmpDokument->datum= date('H:i:s d.m.Y');
        $tmpDokument->ckIdKategorieDokumentu=$tmpKategorie;
        $tmpDokument->ckIdDruhDokumentu=$tmpDruh;
        $this->assertTrue(DokumentRepository::CreateDeep($tmpDokument)>0);


    }

    public function testReadRearDeep() {
        var_dump(DokumentRepository::readRearDeep(1, 5));
        $this->assertTrue(DokumentRepository::readRearDeep(1,5)!==null);
    }

    public function testDelete() {
        $this->assertTrue(DokumentRepository::delete(3)!==null);

    }

    public function testReadAll() {
        var_dump(DokumentRepository::readAll());
        $this->assertTrue(DokumentRepository::readAll()!==null);
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
        var_dump(DokumentRepository::readAllDeep(1));
        $this->assertTrue(DokumentRepository::readAllDeep(1)!==null);
    }

    public function testRead() {
//        var_dump(DokumentRepository::read(1));
        $this->assertTrue(DokumentRepository::read(1)!==null);
    }

    public function testUpdate() {
        $tmp= new Dokument();
        $tmp->id=2;
        $tmp->nadpis="pokusny oprava";
        $tmp->podnadpis="zase neco noveho";
        $this->assertTrue(DokumentRepository::update($tmp));
    }

    public function testReadAllDruh() {
        var_dump(DokumentRepository::readAllDruh(1));
        $this->assertTrue(DokumentRepository::readAllDruh(1)!==null);
    }

    public function testReadDeep() {
//        var_dump(DokumentRepository::readDeep(1));      //todo dodelat druh dokumentu
        $this->assertTrue(DokumentRepository::readDeep(1)!==null);
    }

    public function testReadAllKategorie(){
        var_dump(DokumentRepository::readAllKategorie(1));
        $this->assertTrue(DokumentRepository::readAllKategorie(1)!==null);
    }

    public function testReadAllKategorieDruh(){
        var_dump(DokumentRepository::readAllKategorieDruh(1, 1));
        $this->assertTrue(DokumentRepository::readAllKategorie(1)!==null);
    }
}
