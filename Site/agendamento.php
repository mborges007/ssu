<?php

require_once('agenda.php');
require_once('sessao.php');

validaAcesso("login.php");

$agenda = new Agenda();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Estilo customizado -->
  <link rel="stylesheet" type="text/css" href="css/style_agendamento.css">

  <!-- ICONE -->
  <link rel="icon" href="./img/logo.png">
  <!-- Bootstrap Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>P.i SSU</title>
</head>

<body>
  <!-- Navbar -->
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelector('form').addEventListener('submit', function (event) {
        var dataSelecionada = document.getElementById('dataSelecionada').value;
        
        // Verifica se a data foi selecionada
        if (!dataSelecionada) {
          alert('Por favor, selecione uma data no calendário.');
          event.preventDefault(); // Impede o envio do formulário
        }
      });
    });
  </script>

  <body>
    <form action="agendamento.php" method="GET" novalidate>
      <div id="agendamento-login">
        <div class="container-md mt-5">
          <div class="row">
            <div class="col d-flex flex-column justify-content-center" id="agendamento-pesquisa">
              <h1 id="agendamento-title">Agende sua consulta</h1>
              <p class="text">Selecione o dia que deseja agendar a sua consulta e utilize os filtros para aprimorar sua busca de médicos disponíveis</p>
              <div id="filtros">
                <div class="custom-select-wrapper">
                  <img class="custom-select-img" src="./img/location_icon.svg">
                  <select class="custom-select" name="cidade" placeholder="Selecione uma cidade">
                    <option value="" selected>Selecione uma cidade</option>
                    <?php
                    $cidades = $agenda->listarCidades();
                    foreach ($cidades as $cidade) {
                      echo "<option value='{$cidade}'>{$cidade}</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="custom-select-wrapper">
                  <img class="custom-select-img" src="./img/especialidade_icon.svg">
                  <select class="custom-select" name="especialidade" placeholder="Selecione uma especialidade">
                    <option value="" selected>Selecione uma especialidade</option>
                    <?php
                    $especialidades = $agenda->listarEspecialidades();
                    foreach ($especialidades as $especialidade) {
                      echo "<option value='{$especialidade->getId()}'>{$especialidade->getDescricao()}</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="custom-select-wrapper">
                  <img class="custom-select-img" src="./img/medico_icon.svg">
                  <select class="custom-select" name="medico" placeholder="Selecione um Médico">
                    <option selected>Selecione um médico</option>
                    <?php
                    $medicos = $agenda->listarMedicos();
                    foreach ($medicos as $medico) {
                      echo "<option value='{$medico->getId()}'>{$medico->getNome()}</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="align-self-center">
                <button class="btn-agendamento" type="submit" name="submit">Buscar</button>
              </div>
            </div>
            <div class="col-md-6" id="calendario">
              <input type="hidden" name="dataSelecionada" id="dataSelecionada" value="">
              <div class="calendar calendar-second" style="margin-top: 50px;" id="calendar_first">
                <div class="calendar_header">
                  <button class="switch-month switch-left">
                    <i class="bi-caret-left-fill"></i>
                  </button>
                  <h2></h2> <!--titulo-->
                  <button class="switch-month switch-right">
                    <i class="bi-caret-right-fill"></i>
                  </button>
                </div>
                <div class="calendar_weekdays"></div>
                <div class="calendar_content"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

    <!-- lista de medicos -->
    <?php if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['submit']) && isset($_GET['dataSelecionada'])) :
      $dataSelecionada = $_GET['dataSelecionada'];

      if (empty($dataSelecionada)) {
        return;
      }

      $cidade = $_GET['cidade'];
      $especialidade = intval($_GET['especialidade']);
      $medicoSelecionado = intval($_GET['medico']);

      $medicosFiltrados = $agenda->filtrarMedicos($cidade, $especialidade, $medicoSelecionado);

      $horarios = [7, 8, 9, 10, 11, 13, 14, 15];
    ?>

      <div class="container" id="medicos">
        <h1>Médicos encontrados</h1>

        <?php if (empty($medicosFiltrados)) : ?>
          <h1>Nenhum médico encontrado!</h1>
        <?php else : ?>

          <form method="post" action="meus_agendamentos.php" id="form-agendamento">
            <input type="hidden" name="medico_agenda" id="medico_agenda">
            <input type="hidden" name="hora_agenda" id="hora_agenda">
            <input type="hidden" name="data_agenda" id="data_agenda" value="<?php echo $dataSelecionada; ?>">

            <?php foreach ($medicosFiltrados as $medico) : ?>

              <div class="card">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <h4>Médico: <?php echo $medico->getNome(); ?> </h4>
                    </div>
                    <div class="row">
                      <h6> Especialidade: <?php echo $medico->getEspecialidade()->getDescricao(); ?> </h6>
                    </div>
                    <div class="row">
                      <h6> Cidade: <?php echo $medico->getCidade() ?></h6>
                    </div>
                    <div class="row">
                      <h6> CRM: <?php echo $medico->getCRM() ?> </h6>
                    </div>
                    <div class="row">
                      <button type="submit" name="submit" class="btn btn-color">Agendar</a>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="modal-body">
                      <div class="" role="group" id="agendamento-horarios">
                        <?php
                        $consultas = $agenda->obterHorariosConsulta($medico->getId(), $dataSelecionada);

                        $vagas = [];
                        if ($consultas != null) {
                          $vagas = array_diff($horarios, $consultas);
                        } else {
                          $vagas = $horarios;
                        }

                        foreach ($vagas as $vaga) : ?>
                          <button type="button" class="btn btn-custom m-1 time-slot" data-group="<?php echo $medico->getId(); ?>" onclick="handleButtonClick(this, <?php echo $vaga; ?>)">
                            <?php echo $vaga . ":00" ?>
                          </button>
                        <?php endforeach; ?>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>
          </form>
        <?php endif; ?>

        <script>
          function handleButtonClick(button, hora) {
            console.log("TESTE");
            // Get the data-group attribute value
            var group = $(button).data('group');

            // Unselect all buttons in the same group
            $('.time-slot[data-group="' + group + '"]').removeClass('selected');

            console.log(group);
            console.log(hora);
            // Select the clicked button
            $(button).addClass('selected');
            $('#medico_agenda').val(group);
            $('#hora_agenda').val(hora);
          }
        </script>

      <?php endif; ?>

      <script src="js/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

      <script src="js/calendar.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>

</html>