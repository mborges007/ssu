<?php
require('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $genero = $_POST['genero'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);


    $sql = "INSERT INTO usuarios (nome, cpf, telefone, data_nascimento, genero, email, senha) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $nome, $cpf, $telefone, $data_nascimento, $genero, $email, $senha);
    
    if ($stmt->execute()) {

        header("Location: login.php");
    } else {
        echo "Erro ao cadastrar o usuário: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
