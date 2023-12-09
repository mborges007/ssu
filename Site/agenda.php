<?php

require_once('database.php');

class Agenda {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function listarMedicos() 
    {
        try {
            $conn = $conn = $this->db->getConnection();

            $sql = "SELECT ID, NOME FROM MEDICOS";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $medicos = [];

            foreach ($result as $row) {
                $medico = new Medico();
                $medico->setId($row["ID"]);
                $medico->setName($row["Name"]);

                $medicos[] = $medico;
            }

            return $medicos;
        }
    }

    public function lsitarEspecialidades()
    {
        try {
            $conn = $this->db->getConnection();

            $sql = "SELECT ID, DESCRICAO FROM ESPECIALIDADES";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $especialidades = [];

            foreach ($result as $row) {
                $especialidade = new Especialidade();
                $especialidade->setId($row["ID"]);
                $especialidade->setDescricao($row["DESCRICAO"]);

                $especialidades[] = $especialidade;
            }

            return $especialidades;
        }
    }

    public function listarCidades()
    {
        try {
            $conn = $this->db->getConnection();

            $sql = "SELECT DISTINCT CIDADE FROM UNIDADES";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $cidades = [];

            foreach ($result as $row) {
                $cidade = $row["CIDADE"];
                $cidades[] = $cidade;
            }

            return $cidades;
        }
    }


}