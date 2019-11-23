<?php
require_once "Connection.php";

abstract class RelRepository {
    abstract static function getTableName();
    abstract static function read($id, $fromSide);
    abstract static function create($idLeft, $idRight);
    abstract static function delete($id, $fromSide);
}