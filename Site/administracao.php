<?php
  session_start();

  if(!isset($_SESSION['usuario'])){
    header('location: Login.php');
  }

  echo'
  <!-- Identificar Adm -->
  <div class="container">
    <div class="card bg-light mb-3" style="max-width: 18rem;">
      <div class="card-header">
        <div class="row">
          <div class="col-md-9">
            <label for="">'.$_SESSION['usuario'].'</label>
          </div>
          <div class="col-md-3">
            <a type="button" href="Login.php?signout=1" class="btn btn-danger align-item-end">Sair</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <p class="card-text">Seja bem vindo <strong class="text-primary">Administrador</strong> </p>
      </div>
    </div>
  </div>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link type="text/css" href="css/estilo-administracao.css" rel="stylesheet">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
  <script src="https://kit.fontawesome.com/cabb383e5b.js" crossorigin="anonymous"></script>
  
  <title>Document</title>

  <script src="node_modules/jquery/dist/jquery.min.js"></script>

</head>

<body>
  <div class="container">

    <!-- Banner -->
    <div class="row align-items-center">
      <div class="col-md-4 text-right">
        <img class="img" src="imagens/mogi-logo.png" alt="" width="202px" height="202px" class="img-fluid">
      </div>

      <div id="transparencia" class="col-md-4">
        <h1>Transparência</h1>
        <p>Deixando Mogi das Cruzes transparente para você</p>
      </div>

    </div>

    <!-- Botões -->
    <div class="btn-group" role="group">
      <a class="btn btn-primary btn-opcoes" href="./administracao.php?p=funcionariosPrefeitura">Funcionários Prefeitura</a>
      <a class="btn btn-primary btn-opcoes" href="./administracao.php?p=funcionariosCamara">Funcionários Câmara</a>
      <a class="btn btn-primary btn-opcoes" href="./administracao.php?p=projetos">Projetos</a>
      <a class="btn btn-primary btn-opcoes" href="./administracao.php?p=pesquisa">Pesquisa de Interesses</a>
    </div>

    <!-- Funções-->
    <div class="col-md-12 text-center " id="funcoes">
    <?php

      $valor = @$_GET['p'];

      if($valor == 'funcionariosPrefeitura'|| $valor == NULL){ require_once 'administracao-funcionariosPrefeitura.php';}
      if($valor == 'funcionariosCamara'){ require_once 'administracao-funcionariosCamara.php';}
      if($valor == 'projetos'){ require_once 'administracao-projetos.php';}
      if($valor == 'pesquisa'){ require_once 'administracao-interesses.php';}

    ?>
    </div>
  </div>
  </div>


  <footer id="footer">
    <div class="container">
      <div class="row align-items-end justify-content-center">
        <img id="fatec" class="img-fluid" src="./Imagens/fatec.png" alt="">
        <p>Desenvolvido pelos alunos da Fatec Mogi das Cruzes, orientados pelo professor Leandro Luke</p>
      </div>
    </div>
  </footer>
    
  <!-- Javascript -->
  <script src="node_modules/jquery/dist/jquery.js"></script>
  <scrip src="node_modules/@popperjs\core/dist/umd/popper.js"></scrip>
  <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>


</body>

</html>