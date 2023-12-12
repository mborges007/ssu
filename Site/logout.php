<?php
session_start();

// Destroi a sessão (logout)
session_destroy();

// Redireciona para a página de login ou para a página inicial
header('Location: login.php');
exit();
?>