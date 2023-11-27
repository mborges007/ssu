<?php

class Database {
    private $host = 'seu_servidor';
    private $user = 'seu_usuario';
    private $password = 'sua_senha';
    private $database = 'seu_banco_de_dados';

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