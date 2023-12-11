<?php

require_once('database.php');

class Usuario {
    private $db;
    private int $idUsuario;

    public function __construct() {
        $this->db = new Database();
    }

    public function autenticar($email, $senha) : bool {
        try {
            $conn = $this->db->getConnection();

            $sql = "SELECT REGISTRO, SENHA FROM PACIENTES WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && $senha == $result["SENHA"]) {
                $this->idUsuario = $result['REGISTRO'];
                return true;
            } else {
                ECHO 'fail';
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