<?php

namespace Connection;
use \PDO;
class Connection {
    public $pdo;
    public static $instance;
    final public function __construct($file = "db.sqlite3") {
        $dsn = "sqlite:" . __DIR__ . '/../' . $file;
        try {
            $this->pdo = new PDO($dsn);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("PRAGMA journal_mode = wal;");
            $this->pdo->exec("PRAGMA foreign_keys = ON;");
        } catch (PDOException $e) {
            error_log("Connection failed: " . $e->getMessage());
            error_log("Couldn't properly set up a new Database object");
        }
    }
    public static function getConnection() {
        if (!isset(self::$instance)) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }
    public static function pdo() {
        return self::getConnection()->pdo;
    }
    function disconnect() {
        $this->pdo = null;
    }
}