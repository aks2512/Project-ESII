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
$inicio = ($quantidade_pg * $pagina) - $quantidade_pg;

//verifica se está sendo passado na url a pagina atual, senão é atribuido a pagina
$pagina = isset($_POST['pagina']);

$projetoDao = new \App\Model\ProjetoDao();
if ($projetoDao->read($busca, $projeto, $ano, $inicio, $quantidade_pg) != NULL) {
    foreach ($projetoDao->read($busca, $projeto, $ano, $inicio, $quantidade_pg) as $projeto) :
        echo ' <tr>
                    <td><a href="' . $projeto['link'] . '">' . $projeto['codigo'] . '</a></td>
                    <td><a href="' . $projeto['link'] . '">' . $projeto['autor'] . '</a></td>
                    <td><a href="' . $projeto['link'] . '">' . $projeto['assunto'] . '</a></td>
                    <td><a href="' . $projeto['link'] . '">' . $projeto['anotacao'] . '</a></td>  
                    <td><form action="App/Model/avaliacao.php"><button type="submit" class="btn btn-primary"><i class="fas fa-thumbs-up"></i></button><input value="1" name="positivo" type="hidden"><input value="' . $projeto['codigo'] . '" name="codigo" type="hidden"></form></td>  
                    <td><form action="App/Model/avaliacao.php"><button type="submit" class="btn btn-danger"><i class="fas fa-thumbs-down"></i></button><input value="1" name="negativo" type="hidden"><input value="' . $projeto['codigo'] . '" name="codigo" type="hidden"></form></td>  

                </tr>';
    endforeach;
} else {
    echo '<td></td>
            <td></td>
            <td>Nenhum resultado encontrado...</td>';
}
