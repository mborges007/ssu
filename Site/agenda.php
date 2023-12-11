<?php

require_once('database.php');
require_once('Especialidade.php');
require_once('Medico.php');

class Agenda {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function filtrarMedicos($data, string $cidade = null, int $especialidade = null, string $nome = null) 
    {
        try {
            $conn = $conn = $this->db->getConnection();

            $sql = "SELECT M.ID, M.CRM, M.NOME, M.CIDADE, E.DESCRICAO, A.HORA_CONSULTA FROM MEDICOS M
            INNER JOIN ESPECIALIDADE E ON E.ID = M.ID_ESPECIALIDADE
            INNER JOIN AGENDAMENTOS A ON A.ID_MEDICO = M.ID";

            if ($cidade != null || $especialidade != null || $nome != null)
            {
                $sql .= " WHERE ";

                if ($cidade != null)
                {
                    $sql .= "M.CIDADE = '$cidade'";
                }
            
                if ($especialidade != null)
                {
                    $sql .= ($cidade != null ? " AND " : "") . "M.ID_ESPECIALIDADE = '$especialidade'";
                }
            
                if ($nome != null)
                {
                    $sql .= (($cidade != null || $especialidade != null) ? " AND " : "") . "M.NOME = '$nome'";
                }
            }

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $medicos = [];

            foreach ($result as $row) {
                $medico = new Medico();
                $medico->setId($row["ID"]);
                $medico->setCRM($row["CRM"]);
                $medico->setNome($row["NOME"]);
                $medico->setCidade($row["CIDADE"]);

                $medico->setEspecialidade(new Especialidade());
                $especialidade = $medico->getEspecialidade();
                $especialidade->setId($row["ID_ESPECIALIDADE"]);
                $especialidade->setDescricao($row["DESCRICAO"]);

                $medicos[] = $medico;
            }

            return $medicos;

        }
        catch(PDOException $e) {
            echo "". $e->getMessage();
        }
    }

    public function listarMedicos() 
    {
        try {
            $conn = $conn = $this->db->getConnection();

            $sql = "SELECT M.ID, M.CRM, M.NOME, M.ID_ESPECIALIDADE, E.DESCRICAO FROM MEDICOS M
            INNER JOIN ESPECIALIDADES E ON E.ID = M.ID_ESPECIALIDADE";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $medicos = [];

            foreach ($result as $row) {
                $medico = new Medico();
                $medico->setId($row["ID"]);
                $medico->setCRM($row["CRM"]);
                $medico->setNome($row["NOME"]);

                $medico->setEspecialidade(new Especialidade());
                $especialidade = $medico->getEspecialidade();
                $especialidade->setId($row["ID_ESPECIALIDADE"]);
                $especialidade->setDescricao($row["DESCRICAO"]);

                $medicos[] = $medico;
            }

            return $medicos;
        } 
        catch (PDOException $e) {
            echo "". $e->getMessage();
        }
    }

    public function listarEspecialidades()
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
        catch (PDOException $e) {
            echo "". $e->getMessage();
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
        catch (PDOException $e) {
            echo "". $e->getMessage();
        }
    }


}