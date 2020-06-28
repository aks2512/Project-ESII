<?php

    require_once 'vendor/autoload.php';

    //filtro de pesquisa
    $busca = $_POST['busca'];

    //filtro projeto
    $projeto = $_POST['projeto'];

    //filtro ano
    $ano = $_POST['ano'];

    //verifica se está sendo passado na url a pagina atual, senão é atribuido a pagina
    $pagina = isset($_POST['pagina']) ? $_POST['pagina'] : 1;

    //seta a quantidade de funcionarios por pagina
    $quantidade_pg = $_POST['mostrar'];

    //calcula o inicio da vizualização
    $inicio = ($quantidade_pg*$pagina)-$quantidade_pg;

    //verifica se está sendo passado na url a pagina atual, senão é atribuido a pagina
    $pagina = isset($_POST['pagina']);

    $projetoDao = new \App\Model\ProjetoDao();
    if($projetoDao->read($busca,$projeto,$ano,$inicio,$quantidade_pg) != NULL){
        foreach($projetoDao->read($busca,$projeto,$ano,$inicio,$quantidade_pg) as $projeto):
            echo' <tr>
                    <td><input type="checkbox" value="'.$projeto['id'].'" id="'.$projeto['id'].'" name="projeto"></td>
                    <td><a href="'.$projeto['link'].'">'.$projeto['id'].'</a></td>
                    <td><a href="'.$projeto['link'].'">'.$projeto['autor'].'</a></td>
                    <td><a href="'.$projeto['link'].'">'.$projeto['assunto'].'</a></td>
                    <td><a href="'.$projeto['link'].'">'.$projeto['anotacao'].'</a></td>  
                    <td><button id="'.$projeto['id'].'" data-toggle="modal"  class="btn btn-primary view-data" onclick="atualizar()">Editar</button><td>         
                </tr>';
            endforeach;
        }else{
            echo '<td></td>
            <td></td>
            <td>Nenhum resultado encontrado...</td>';
        }

?> 


