<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('cadastro.php');
    $cadastro = new Cadastro();
    
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $dataNascimento = $_POST['data_nascimento'];
    $genero = $_POST['genero'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $cadastradoComSucesso = $cadastro->cadastrarUsuario($nome, $cpf, $telefone, $dataNascimento, $genero, $email, $senha);

    if ($cadastradoComSucesso) {
        echo "Usuário cadastrado com sucesso!";
        header('Location: login.php');
    } else {
        echo "Erro ao cadastrar o usuário. Verifique os dados e tente novamente.";
    }
}
?>