<?php
$hostname = "seu_servidor";
$username = "seu_usuario";
$password = "sua_senha";
$database = "seu_banco_de_dados";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>
