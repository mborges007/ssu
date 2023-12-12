<?php

require_once('database.php');
require_once('Especialidade.php');
require_once('Medico.php');

class Agenda {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function agendarConsulta($dataConsulta, $idMedico, $idPaciente, $hora)
    {
        try {
            $conn = $this->db->getConnection();

            $sql = "SELECT agendarConsulta('$dataConsulta', $idMedico, $idPaciente, $hora) as agenda_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetch();
            
        }
        catch(PDOException $e) {
            echo "". $e->getMessage();
        }
    }

    public function filtrarMedicos(string $cidade = null, int $especialidade = null, int $medico = null) 
    {
        try {
            $conn = $this->db->getConnection();

            $sql = "SELECT M.ID, M.CRM, M.NOME, M.CIDADE, E.DESCRICAO FROM MEDICOS M
            INNER JOIN ESPECIALIDADES E ON E.ID = M.ID_ESPECIALIDADE";

            if ($cidade != null || $especialidade != null || $medico != null)
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
            
                if ($medico != null)
                {
                    $sql .= (($cidade != null || $especialidade != null) ? " AND " : "") . "M.ID = '$medico'";
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
                $especialidade->setDescricao($row["DESCRICAO"]);

                $medicos[] = $medico;
            }

            return $medicos;

        }
        catch(PDOException $e) {
            echo "". $e->getMessage();
        }
    }

    public function obterHorariosConsulta(int $medicoId, $dia)
    {
        try{
            $conn = $this->db->getConnection();

            $query = "CALL ObterHorariosConsulta($medicoId, '$dia')";
            $stmt = $conn->prepare($query);

            $stmt->execute();
            $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            $horarios = [];
            foreach ($result as $row){
                $horarios[] = intval($row['hora_consulta']);
            }

            return $horarios;
        }
        catch(PDOexception $e){
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