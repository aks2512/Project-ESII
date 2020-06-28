<?php

//verifica se está sendo passado na url a pagina atual, senão é atribuido a pagina
  $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

  //seleciona todos os funcionarios
  $sql = 'SELECT * FROM funcionarios';

  $stmt = \App\Model\DB::getCon()->prepare($sql);
  $stmt->execute();

  //conta o total de funcionarios
  $total_funcionarios = $stmt->rowCount();
  echo $total_funcionarios;

  //seta a quantidade de funcionarios por pagina
  $quantidade_pg = 1;

  //calcula a quantidade de paginas necessarias para apresentar os funcionarios
  $num_pagina = ceil($total_funcionarios / $quantidade_pg);

  //calcula o inicio da vizualização
  $inicio = ($quantidade_pg*$pagina)-$quantidade_pg;

  //selecionar os funcionarios a serem apresentado
  //$result_funcionarios = "SELECT * FROM cursos limit '$inicio','$quantidade_pg'"

  ?>