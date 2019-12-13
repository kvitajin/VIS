<?php
require_once __DIR__ . "/../repository/UzivatelRepository.php";
use flight\Engine;
session_start();


$email=$_POST["email"];
$passwd=$_POST["heslo"];


function loginUser($email, $passwd){
    if (UzivatelRepository::userExists($email)) {
        $dbpasswd = UzivatelRepository::getUserPasswd($email);
        if (password_verify($passwd, $dbpasswd)) {
            return  UzivatelRepository::read($email);
        }
        throw new Exception ("Wrong password");
    }
    throw new Exception ("User not in DB");
}
try {
    $user=loginUser($email, $passwd);
}catch (Exception $e){
    echo "Exeption: "  . $e->getMessage();          //TODO pak predat do chybove stranky
}finally{
    $_SESSION["mail"]=$user["email"];
    $_SESSION["nick"]=$user["nick"];
    $_SESSION["ban"]=$user["ban"];
    header("Location:/".Flight::get('obec'));
}