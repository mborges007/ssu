<?php

<<<<<<< Updated upstream
=======
<<<<<<< HEAD
require_once('database.php');

class Medico {
    private int $id;
    private string $nome;
    private string $crm;
    private int $especialidade;


    public function __construct() {
        $this->db = new Database();
=======
>>>>>>> Stashed changes
class Medico {
    private int $id;
    private string $nome = "";
    private string $crm = "";
    private string $cidade = "";
    private Especialidade $especialidade;


    public function __construct() {
        
<<<<<<< Updated upstream
=======
>>>>>>> 48a5a95b014a2b56cfc8e28ed88c8027bbddca61
>>>>>>> Stashed changes
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome){
        $this->nome = $nome;
    }

    public function getCRM(): string {
        return $this->crm;
    }

    public function setCRM(string $crm){
        $this->crm = $crm;
    }

<<<<<<< Updated upstream
=======
<<<<<<< HEAD
    public function getEspecialidade(): int {
        return $this->especialidade;
    }

    public function setEspecialidade(int $especialidade){
=======
>>>>>>> Stashed changes
    public function getCidade(): string {
        return $this->cidade;
    }

    public function setCidade(string $cidade) {
        $this->cidade = $cidade;
    }

    public function getEspecialidade(): Especialidade {
        return $this->especialidade;
    }

    public function setEspecialidade(Especialidade $especialidade){
<<<<<<< Updated upstream
=======
>>>>>>> 48a5a95b014a2b56cfc8e28ed88c8027bbddca61
>>>>>>> Stashed changes
        $this->especialidade = $especialidade;
    }
}