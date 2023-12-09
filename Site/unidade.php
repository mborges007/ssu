<?php

class unidade {
    private int $id;
    private string $endereco;
    private int $qtdMedico;
    private string $telefone;
    private string $cidade;

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function getEndereco(): string {
        return $this->endereco;
    }

    public function setEndereco(string $endereco){
        $this->endereco = $endereco;
    }

    public function getQtdMedico(): int {
        return $this->qtdMedico;
    }

    public function setQtdMedico(int $qtdMedico){
        $this->qtdMedico = $qtdMedico;
    }

    public function getTelefone(): string {
        return $this->telefone;
    }

    public function setTelefone(string $telefone) {
        $this->telefone = $telefone;
    }

    public function getCidade(): string {
        return $this->cidade;
    }

    public function setCidade(string $cidade) {
        $this->cidade = $cidade;
    }
}