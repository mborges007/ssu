<?php

require_once('database.php');
<<<<<<< Updated upstream
require_once('Especialidade.php');
require_once('Medico.php');
=======
<<<<<<< HEAD
=======
require_once('Especialidade.php');
require_once('Medico.php');
>>>>>>> 48a5a95b014a2b56cfc8e28ed88c8027bbddca61
>>>>>>> Stashed changes

class Agenda {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

<<<<<<< Updated upstream
    public function filtrarMedicos($data, string $cidade = null, int $especialidade = null, string $nome = null) 
=======
<<<<<<< HEAD
    public function listarMedicos() 
=======
    public function filtrarMedicos($data, string $cidade = null, int $especialidade = null, string $nome = null) 
>>>>>>> 48a5a95b014a2b56cfc8e28ed88c8027bbddca61
>>>>>>> Stashed changes
    {
        try {
            $conn = $conn = $this->db->getConnection();

<<<<<<< Updated upstream
=======
<<<<<<< HEAD
            $sql = "SELECT ID, NOME FROM MEDICOS";
=======
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
=======
>>>>>>> 48a5a95b014a2b56cfc8e28ed88c8027bbddca61
>>>>>>> Stashed changes
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $medicos = [];

            foreach ($result as $row) {
                $medico = new Medico();
                $medico->setId($row["ID"]);
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
                $medico->setName($row["Name"]);
=======
>>>>>>> Stashed changes
                $medico->setCRM($row["CRM"]);
                $medico->setNome($row["NOME"]);
                $medico->setCidade($row["CIDADE"]);

                $medico->setEspecialidade(new Especialidade());
                $especialidade = $medico->getEspecialidade();
                $especialidade->setId($row["ID_ESPECIALIDADE"]);
                $especialidade->setDescricao($row["DESCRICAO"]);
<<<<<<< Updated upstream
=======
>>>>>>> 48a5a95b014a2b56cfc8e28ed88c8027bbddca61
>>>>>>> Stashed changes

                $medicos[] = $medico;
            }

            return $medicos;
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
=======
>>>>>>> Stashed changes

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
<<<<<<< Updated upstream
=======
>>>>>>> 48a5a95b014a2b56cfc8e28ed88c8027bbddca61
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
        catch (PDOException $e) {
            echo "". $e->getMessage();
        }
=======
<<<<<<< HEAD
=======
        catch (PDOException $e) {
            echo "". $e->getMessage();
        }
>>>>>>> 48a5a95b014a2b56cfc8e28ed88c8027bbddca61
>>>>>>> Stashed changes
    }

    public function listarCidades()
    {
        try {
            $conn = $this->db->getConnection();

            $sql = "SELECT DISTINCT CIDADE FROM UNIDADES";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

<<<<<<< Updated upstream
            
=======
<<<<<<< HEAD
=======
            
>>>>>>> 48a5a95b014a2b56cfc8e28ed88c8027bbddca61
>>>>>>> Stashed changes
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $cidades = [];

            foreach ($result as $row) {
                $cidade = $row["CIDADE"];
                $cidades[] = $cidade;
            }

            return $cidades;
        }
<<<<<<< Updated upstream
        catch (PDOException $e) {
            echo "". $e->getMessage();
        }
=======
<<<<<<< HEAD
=======
        catch (PDOException $e) {
            echo "". $e->getMessage();
        }
>>>>>>> 48a5a95b014a2b56cfc8e28ed88c8027bbddca61
>>>>>>> Stashed changes
    }


}