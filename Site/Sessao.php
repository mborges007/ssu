<?php

require_once('login.php');

$loginFalhou = false;
    
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    if (!isset($_POST['action'])){
        return;
    }

    $action = $_POST['action'];
    if ($action == "logar")
    {
        session_start();

        $login = new Login();
        $logou = $login->autenticar($_POST['login'], $_POST['senha']);

        if(empty($logou))
        {
            $_SESSION['loggedin'] = FALSE;
            $loginFalhou = true;
        }
        else
        {
            $_SESSION["loggedin"] = TRUE;
            $_SESSION["id"] = $login->getUsuario();
            header("Location: index.php");
            exit;
        }
    }
    else if ($action == "logout")
    {
        session_start();
        Logout();

    }
}

function ValidaAcesso(string $tipoUsuario){
    session_start();
    
    if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]){
        header("location: index.php");
        exit;
    }
}

function VerificaSeJaEstaLogado()
{
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]){
        return;
    }

    header("location: index.php");
}

function Logout(){
    $_SESSION["loggedin"] = false;
    
    unset($_SESSION["loggedin"]);
    unset($_SESSION["id"]);

    header("Location: index.php");
}

?>