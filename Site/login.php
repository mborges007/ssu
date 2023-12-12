<?php

require_once('sessao.php');
require_once('usuario.php');

if (verificaSeJaEstaLogado())
{
    header("location: index.php");
}
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Estilo customizado -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- ICONE -->
    <link rel="icon" href="./img/logo.png">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>P.i SSU</title>

</head>
<body>

<!-- login -->
<div class="container">
    <div class="row text-center">
        <a href="index.html"><img src="./img/Logo+escrita_sem_fundo.png" alt="Logotipo" width="19%" class="mt-5 mb-5"></a>
    </div>
    <div class="login" id="login">
        <div class="row">
            <a class="col-sm-6 acessar-p" href="login.php">Fazer login</a>
            <a class="col-sm-6 acessar-n" href="cadastro.html">Criar conta</a> 
        </div>
        <h2>Acesse sua conta</h2>  
        <form action="login.php" method="post">
            <input type="hidden" name="action" value="logar">
            <div class="form">
                <div class="row">
                    <input class="form-control" type="email" name="email" placeholder="E-mail" required>
                </div>
                <div class="row">
                    <input class="form-control" type="password" name="senha" placeholder="Senha" required>
                </div>
            </div>
            <a class="esq" href="#">Esqueceu sua senha?</a>
            <?php
            if (isset($errorMessage)) {
                echo '<div class="error-message">' . $errorMessage . '</div>';
            }
            ?>
            <button class="btn" type="submit">Entrar</button>
        </form>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">    
</body>
</html>