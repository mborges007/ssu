<?php

require_once('sessao.php');

validaAcesso("login.php");
require_once('usuario.php');

$user = new Usuario();

$id_paciente = $_SESSION["id"];
$perfil = $user->Perfil($id_paciente);

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Estilo customizado -->
      <link rel="stylesheet" type="text/css" href="./css/style_user.css">
      <!-- JS -->
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      <!-- ICONE -->
      <link rel="icon" href="./img/logo.png">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend:wght@900&display=swap">
      <!-- Bootstrap Icon -->
      <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Bootstrap JS e dependências Popper.js e jQuery -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <title>Editar usuário</title>
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
            </div>
          </div>
        </nav>
      </header>

 <section class="USUARIO">     
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="./img/img-user/gamer.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="155">
                                <div class="mt-3">
                                    <h4><?php echo $perfil['nome']; ?></h4>
                                    <p class="text-secondary mb-1">Paciente</p>
                                    <p class="text-muted font-size-sm">Araras - SP</p>
                                </div>
                            </div>
                            <hr class="my-4">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nome</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="<?php echo $perfil['nome']; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">CPF</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="<?php echo $perfil['cpf']; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Data Nascimento</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="<?php echo $perfil['data_nasc']; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="<?php echo $perfil['email']; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Celular</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="<?php echo $perfil['telefone']; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Endereço</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="Rua Luiz Amorim">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Bairro</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="jd candida">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">N°</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="458">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nova Senha</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="password" class="form-control" value="***********">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Confirmar Senha</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="password" class="form-control" value="***********">
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <!-- Botão para abrir o modal -->
                                    <button type="button" class="btn btn-primary px-4" data-toggle="modal" data-target="#confirmacaoModal">
                                        Salvar Alterações
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Modal de confirmação -->
                            <div class="modal fade" id="confirmacaoModal" tabindex="-1" role="dialog" aria-labelledby="confirmacaoModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmacaoModalLabel">Confirmação</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Tem certeza de que deseja salvar as alterações?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- Botão de cancelar o salvamento -->
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <!-- Botão de confirmar o salvamento -->
                                            <button type="button" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>