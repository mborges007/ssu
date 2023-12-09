<?php

require_once('database.php');

class Medico {
    private int $id;
    private string $name;
    private string $crm;
    private int $especialidade;


    public function __construct() {
        $this->db = new Database();
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function getCRM(): string {
        return $this->crm;
    }

    public function setCRM(string $crm){
        $this->crm = $crm;
    }

    public function getEspecialidade(): int {
        return $this->especialidade;
    }

    public function setEspecialidade(int $especialidade){
        $this->especialidade = $especialidade;
    }
}