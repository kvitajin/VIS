<?php
require_once "src/repository/ObecRepository.php";
require_once "src/repository/UzivatelRepository.php";
require_once "src/repository/SkupinaUzivatelRepository.php";

\Connection\Connection::getConnection();
//$obec = new Obec();
//$obec->erb="sdjnskcjsndckjsns";
//$obec->nazev="Rybi";
//$obec->uri="rybi";
//var_dump(ObecRepository::create($obec));


$uzivatel= new Uzivatel();
//$uzivatel->nick="asdjnds";
//$uzivatel->heslo="qwerty";
//$uzivatel->hesloZnova="qwerty";
//$uzivatel->email="dsdkjnsd@sjdsj.cz";
//$tmp=new DateTime('2000-01-01');
//$uzivatel->datumNarozeni= date_format($tmp, 'Y-m-d');
//$uzivatel->ban=0;
//$uzivatel->ckIdObec=1;
//UzivatelRepository::create($uzivatel);
$uzivatel->id=1;
//$skupina= new Skupina();
//$skupina->nazev = "tvori neco";
//$skupina->opravneni=1;
//SkupinaRepository::create($skupina);
//SkupinaUzivatelRepository::create(1,2);


echo "<pre>";
print_r(UzivatelRepository::read(1));
echo "</pre>";