<?php
    require_once('db.class.php');

    
    $mostrar = $_POST['mostrar'];
    $filtro = $_POST['filtro'];
    $buscar = $_POST['buscar'];
    $objDb = new db();
    $link = $objDb->conecta_mysql();
    
    $sql = " SELECT u.*, us.* ";
    $sql.= " FROM funcionarios";
    $sql.= " WHERE nome like '%$buscar%'";

    $resultado_id = mysqli_query($link, $sql);

    if($resultado_id){

        while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){

            echo'<tr>';
                echo'<th scope="row">'.$registro['id'].'</th>';
                echo'<td>'.$registro['nome']'</td>';
                echo'<td>'.$registro['cargo']'</td>';
                echo'<td>'.$registro['remuneracao']'</td>';
            echo'</tr>

        }

    }else{
    
        echo 'Erro na consulta!';

    }

?>