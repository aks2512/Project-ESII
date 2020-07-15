<?php

    require_once 'vendor/autoload.php';

     //verifica se está sendo passado na url a pagina atual, senão é atribuido a pagina
     $pagina = isset($_POST['pagina']) ? $_POST['pagina'] : 1;

     //seta a quantidade de funcionarios por pagina
     $quantidade_pg = 10;
 
     //calcula o inicio da vizualização
     $inicio = ($quantidade_pg*$pagina)-$quantidade_pg;
 
     //verifica se está sendo passado na url a pagina atual, senão é atribuido a pagina
     $pagina = isset($_POST['pagina']);
 

    $pesquisaInteressesDao = new \App\Model\PesquisaInteressesDao();
    if($pesquisaInteressesDao->read($inicio,$quantidade_pg) != NULL){
        foreach($pesquisaInteressesDao->read($inicio,$quantidade_pg) as $interesse):
            echo'
            <tr>
                <td>'.$interesse['id'].'</td>
                <td>'.$interesse['ip'].'</td>
                <td>'.$interesse['tabela'].'</td>
                <td>'.$interesse['filtro'].'</td>
                <td>'.$interesse['modificado'].'</td>
            </tr>';
            endforeach;
        }else{
            echo '<td></td>
            <td></td>
            <td>Nenhum resultado encontrado...</td>';
        }

?> 


