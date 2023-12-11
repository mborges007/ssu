<?php

class Medico {
    private int $id;
    private string $nome = "";
    private string $crm = "";
    private string $cidade = "";
    private Especialidade $especialidade;


    public function __construct() {
        
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
        $this->especialidade = $especialidade;
    }
}