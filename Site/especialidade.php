<?php

class Especialidade {
    private int $id;
    private string $descricao;

<<<<<<< Updated upstream
    public function __construct() {
        
    }
=======
<<<<<<< HEAD
=======
    public function __construct() {
        
    }
>>>>>>> 48a5a95b014a2b56cfc8e28ed88c8027bbddca61
>>>>>>> Stashed changes
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function setDescricao(string $descricao){
        $this->descricao = $descricao;
    }
}