<?php

namespace App;
use PDO;
use PDOException;

class DBConnection
{
    private $db_host;
    private $db_user;
    private $db_pass;
    private $db_name;
    private $connection;

    private static $instance; // The single instance of the class

    private function __construct()
    {
        $this->db_host = 'localhost';
        $this->db_user = 'root';
        $this->db_pass = '';
        $this->db_name = 'blogs';
        $this->connect(); // Automatically establish the connection
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function connect()
    {
        try {
            $this->connection = new PDO(
                "mysql:host={$this->db_host};dbname={$this->db_name}",
                $this->db_user,
                $this->db_pass
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

?>