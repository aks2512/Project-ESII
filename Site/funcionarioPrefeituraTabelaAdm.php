<?php

    require_once 'vendor/autoload.php';

    //filtro de pesquisa
    $busca = $_POST['busca'];

    //verifica se está sendo passado na url a pagina atual, senão é atribuido a pagina
    $pagina = isset($_POST['pagina']) ? $_POST['pagina'] : 1;

    //seta a quantidade de funcionarios por pagina
    $quantidade_pg = $_POST['mostrar'];

    //calcula o inicio da vizualização
    $inicio = ($quantidade_pg*$pagina)-$quantidade_pg;

    //verifica se está sendo passado na url a pagina atual, senão é atribuido a pagina
    $pagina = isset($_POST['pagina']);

    $funcionarioDao = new \App\Model\FuncionarioPrefeituraDao();
    if($funcionarioDao->read($busca,$inicio,$quantidade_pg) != NULL){
        foreach($funcionarioDao->read($busca,$inicio,$quantidade_pg) as $funcionario):
            echo' <tr>
                  <td><input type="checkbox" value="'.$funcionario['rgf'].'" id="'.$funcionario['rgf'].'" name="funcionario"></td>
                  <td>'.$funcionario['id'].'</td>
                  <td>'.$funcionario['nome'].'</td>
                  <td>'.$funcionario['cargo'].'</td>
                  <td>'.$funcionario['tbruto'].'</td>
                  <td>'.$funcionario['rgf'].'</td>
                  <td><button id="'.$funcionario['rgf'].'" data-toggle="modal"  class="btn btn-primary view-data" onclick="atualizar()">Editar</button><td>
                </tr>';
            endforeach;
        }else{
            echo '<td></td>
            <td></td>
            <td>Nenhum resultado encontrado...</td>';
        }

?> 


