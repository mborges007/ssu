<?php

require_once('database.php');

class Login {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function verificarCredenciais($email, $senha) {
        try {
            $conn = $this->db->getConnection();

            $sql = "SELECT * FROM usuarios WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($senha, $result['senha'])) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro ao verificar credenciais: " . $e->getMessage();
            return false;
        }
    }
}