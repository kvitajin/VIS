<?php

session_start();
unset($_SESSION['mail']);
unset($_SESSION['ban']);
unset($_SESSION['nick']);
$tmp=$_SESSION['obec'];
echo $tmp;
header('Location: /'.$tmp);
die();