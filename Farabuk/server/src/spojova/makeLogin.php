<?php
require_once __DIR__ . "/../repository/UzivatelRepository.php";
use flight\Engine;
session_start();


$email=$_POST["email"];
$passwd=$_POST["heslo"];
//echo $email. "<br>";

function loginUser($email, $passwd){
    if (UzivatelRepository::userExists($email)) {
        $dbpasswd = UzivatelRepository::getUserPasswd($email);
//        var_dump($dbpasswd);
//        echo "<br>//////////////////////<br>";
        if (password_verify($passwd, $dbpasswd)) {
            echo "tuto";
            return  UzivatelRepository::read($email);
        }
        throw new Exception ("Wrong password");
    }
    throw new Exception ("User not in DB");
}
try {
    $user= new Uzivatel();
    $user=loginUser($email, $passwd);
    //echo $user;
}catch (Exception $e){
    echo "Exeption: "  . $e->getMessage();          //TODO pak predat do chybove stranky
}finally{
    var_dump( $user);
    $_SESSION["mail"]=$user->email;
    $_SESSION["nick"]=$user->nick;
    $_SESSION["ban"]=$user->ban;
    $tmp=$_SESSION['obec'];
    echo $tmp;
        header('Location: /'.$tmp);
        die();
}