<?php

require_once('agenda.php');
require_once('sessao.php');

validaAcesso("login.php");

$agenda = new Agenda();
$id_paciente = $_SESSION["id"];

if ($_SERVER['REQUEST_METHOD'] == 'POST' )
{
  $data = $_POST['data_agenda'];
  $id_medico = $_POST['medico_agenda'];
  $hora = $_POST['hora_agenda'];

  $agenda->agendarConsulta($data, $id_medico, $id_paciente, $hora);

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Estilo customizado -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- ICONE -->
  <link rel="icon" href="./img/logo.png">
  <!-- Bootstrap Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <title>P.i SSU</title>

</head>
<body>

<header>
  <nav class="navbar navbar-expand-md fixed-top">
    <div class="container">
      <a href="index.html"><img src="./img/Logo+escrita_sem_fundo.png" alt="Logotipo" width="175" class="img-nav"></a>

      <button class="navbar-toggler" data-toggle="collapse" data-target="#navCollapse"> <!--botão da navbar no small-->
        <i class="bi bi-list bi-color"></i>
      </button>

      <!--<div class="collapse navbar-collapse" id="navCollapse">-->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="./agendamento.php" class="nav-link">Nova Consulta</a>
          </li>
          <li class="nav-item">
            <a href="meus_agendamentos.php" class="nav-link">Meus agendamentos</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <button class="btn-nav">
              <a href="usuario.html" class="nav-link">
                <i class="bi bi-person-circle"></i> Meu Perfil
              </a>
            </button>
          </li>
          <li class="nav-item">
            <button class="btn-nav">
              <a href="logout.php" class="nav-link">
                <i class="https://icons8.com.br/icon/2444/sair"></i> Sair
              </a>
            </button>
          </li>
        </ul>
        </ul>
      </div>
    </div>
  </nav>
</header>

<!-- tabela de agendamento-->
<section id="tabela"> 
  <div class="container">
    <div class="row">
      <h1>Meus agendamentos</h1>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Data da consulta</th>
          <th scope="col">Horário</th>
          <th scope="col">Médico</th>
          <th scope="col">Unidade de atendimento</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
      <?php 
        $result = $agenda->carregarAgendas($id_paciente);

        foreach ($result as $a) : ?>
        <tr>
          <td><?php echo $a['data_consulta'] ?></td>
          <td><?php echo $a['hora_consulta'] ?></td>
          <td><?php echo $a['nome'] ?></td>
          <td><?php echo $a['endereco'] ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>