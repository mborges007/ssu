<?php


$loginFalhou = false;
    
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    if (!isset($_POST['action'])){
        return;
    }

    $action = $_POST['action'];
    if ($action == "logar")
    {
        require_once('usuario.php');

        session_start();

        $login = new Usuario();
        $logou = $login->autenticar($_POST['email'], $_POST['senha']);

        if(empty($logou))
        {
            $_SESSION['loggedin'] = FALSE;
            $loginFalhou = true;
        }
        else
        {
            $_SESSION["loggedin"] = TRUE;
            $_SESSION["id"] = $login->getUsuario();
            header("Location: agendamento.php");
            exit;
        }
    }
    else if ($action == "logout")
    {
        session_start();
        Logout();

    }
}

function validaAcesso(string $redireciona = ""){
    session_start();
    
    if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]){
        header($redireciona != "" ? "location: $redireciona" : "index.html");
        exit;
    }
}

function verificaSeJaEstaLogado()
{
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]){
        return;
    }

    header("location: index.html");
}

function logout(){
    $_SESSION["loggedin"] = false;
    
    unset($_SESSION["loggedin"]);
    unset($_SESSION["id"]);

    header("Location: index.html");
}

?>