<?php

require_once('database.php');

class Login {
    private $db;
    private int $idUsuario;

    public function __construct() {
        $this->db = new Database();
    }

    public function autenticar($email, $senha) {
        try {
            $conn = $this->db->getConnection();

            $sql = "SELECT REGISTRO, SENHA FROM usuarios WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($senha, $result['senha'])) {
                $this->idUsuario = $result['REGISTRO'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro ao verificar credenciais: " . $e->getMessage();
            return false;
        }
    }

    public function getUsuario() : int {
        return $this->idUsuario;
    }
}