<?php

require_once __DIR__ . '/../common/Constants.php';

if (file_exists(DB_PATH)) {
    unlink(DB_PATH);
}
$db = new PDO("sqlite:" . DB_PATH);

$db->exec(file_get_contents(__DIR__ . "/create.sql"));
$db->exec(file_get_contents(__DIR__ . "/insert.sql"));
