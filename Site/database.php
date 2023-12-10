<?php

class Database {
    private $host = '127.0.0.1';
    private $user = 'root';
    private $password = '';
    private $database = 'ssu';

    protected $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro na conexão com o banco de dados: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}