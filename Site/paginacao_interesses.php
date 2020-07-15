<?php

    require_once 'vendor/autoload.php';

    //verifica se está sendo passado na url a pagina atual, senão é atribuido a pagina
    $paginaAtual = isset($_POST['pagina']) ? $_POST['pagina'] : 1;

    //seleciona todos os funcionarios
    $sql = "SELECT * ";
    $sql.= "FROM pesquisa_interesses "; 

    $stmt = \App\Model\DB::getCon()->prepare($sql);
    $stmt->execute();

    //conta o total de funcionarios
    $total_projetos = $stmt->rowCount();

    //seta a quantidade de funcionarios por pagina
    $quantidade_pg = 10;

    //calcula a quantidade de paginas necessarias para apresentar os funcionarios
    $num_pagina = ceil($total_projetos / $quantidade_pg);

    //calcula o inicio da vizualização
    $inicio = ($quantidade_pg*$paginaAtual)-$quantidade_pg;
    echo'<!-- nº Registros e Paginação -->
    <div class="row justify-align-center align-items-center">
    <div class="col-md-6 text-center">
        <p><strong>Numero de Registros:</strong> '.$total_projetos.'</p>
    </div>
    <div class="col-md-6">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a  id="1" class="page-link" href="">&laquo;</a></li>';

                for($i = $paginaAtual - 3, $limiteDePg = $i + 6; $i<=$limiteDePg;$i++){
                    if($i < 1){
                        $i = 1;
                        $limiteDePg = 7;
                    }
                    if($limiteDePg > $num_pagina){
                        $limiteDePg = $num_pagina;
                        $i = $limiteDePg - 6;
                    }
                    if($i < 1){
                        $i = 1;
                        $limiteDePg = $num_pagina;
                    }
                        
                    if($i == $paginaAtual)
                        echo'<li class="page-item"><a  id="'.$i.'" class="page-link" href="">'.$i.'</a></li>';
                    else
                        echo'<li class="page-item"><a  id="'.$i.'" class="page-link" href="">'.$i.'</a></li>';
                }

                echo'<li class="page-item"><a  id="'.$num_pagina.'" class="page-link" href="">&raquo;</a></li>
            </ul>
        </nav>
    </div>
    </div>';
?>