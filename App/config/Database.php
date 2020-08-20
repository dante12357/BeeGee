<?php

class Database
{

    private $conn;

    private static  $instance = null;
    private  $host = "localhost";
    private  $user = "root";
    private  $pass = "root";
    private  $db_name = "myDB";

    private function __construct()
    {
        $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->pass);

    }

    public static function getInstance()
    {
        if (self::$instance != null) {
            return self::$instance;
        }

        return new self;
    }
    public function getConnection()
    {
        return $this->conn;
    }
}

