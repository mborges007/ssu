<?php

require_once('database.php');

class Cadastro {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function cadastrarUsuario($nome, $cpf, $telefone, $dataNascimento, $genero, $email, $senha) {
        try {
            $conn = $this->db->getConnection();

            $sql = "INSERT INTO usuarios (nome, cpf, telefone, data_nascimento, genero, email, senha) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nome, $cpf, $telefone, $dataNascimento, $genero, $email, password_hash($senha, PASSWORD_DEFAULT)]);

            return true;
        } catch (PDOException $e) {
            echo "Erro ao cadastrar o usuário: " . $e->getMessage();
            return false;
        }
    }
}