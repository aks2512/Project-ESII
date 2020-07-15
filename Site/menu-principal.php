<?php

session_start();

$_SESSION['ip_user'] = $_SERVER['REMOTE_ADDR'];

?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link type="text/css" href="./css/estilo-menu.css" rel="stylesheet">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">

  <title>Document</title>

  <script src="node_modules/jquery/dist/jquery.min.js"></script>

</head>

<body>
  <div class="container">

    <!-- Banner -->
    <div class="row align-items-center">
      <div class="col-md-5 text-right">
        <img class="img" src="imagens/mogi-logo.png" alt="" width="202px" height="202px" class="img-fluid">
      </div>

      <div id="transparencia" class="col-md-7">
        <h1>Transparência</h1>
        <p>Deixando Mogi das Cruzes transparente para você</p>
      </div>

    </div>

    <div class="btn-group" role="group">
      <a class="btn btn-primary btn-opcoes" href="./menu-principal.php?p=funcionariosPrefeitura">Funcionários Prefeitura</a>
      <a class="btn btn-primary btn-opcoes" href="./menu-principal.php?p=funcionariosCamara">Funcionários Câmara</a>
      <a class="btn btn-primary btn-opcoes" href="./menu-principal.php?p=projetos">Projetos</a>
    </div>

    <!-- Funções-->
    <div class="col-md-12 text-center" id="funcoes">
      <?php


      $valor = @$_GET['p'];

      if ($valor == 'funcionariosPrefeitura' || $valor == NULL) {
        require_once 'menu-funcionariosPrefeitura.php';
      }
      if ($valor == 'funcionariosCamara') {
        require_once 'menu-funcionariosCamara.php';
      }
      if ($valor == 'projetos') {
        require_once 'menu-projetos.php';
      }

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