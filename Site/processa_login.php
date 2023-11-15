<?php
require('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($senha, $row['senha'])) {
            // Login bem-sucedido
            session_start();
            $_SESSION['usuario_id'] = $row['id'];
            header("Location: sua_pagina_de_destino.php");
        } else {
            echo "Credenciais inválidas. Tente novamente.";
        }
    } else {
        echo "Credenciais inválidas. Tente novamente.";
    }

    $stmt->close();
}

$conn->close();
?>
