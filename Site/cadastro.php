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

            $sql = "INSERT INTO pacientes (nome, cpf, telefone, data_nasc, sexo, email, senha) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nome, $cpf, $telefone, $dataNascimento, $genero, $email, $senha]);

            return true;
        } catch (PDOException $e) {
            echo "Erro ao cadastrar o usuÃ¡rio: " . $e->getMessage();
            return false;
        }
    }
}