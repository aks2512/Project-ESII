<?php
    $filtro = $_POST['filtro'];
    $linhas = $_POST['linhas'];
    $busca = $_POST['busca'];


    //conexão com banco de dados
    $conn = new mysqli("localhost", "root", "", "transparenciamc");
    if( $conn ->connect_error) {
    exit('Erro na conexao');
    }


    //obs: a variavel $busca está entre aspas simples pois deve ser analisada como valor e não como coluna
    $sql = "SELECT id,Nome,Cargo,Remuneracao FROM funcionarios_bd WHERE '$busca' = $filtro";

    $query =  $conn->query($sql);
    

    if(!$query){//Detecta erro da query
        trigger_error('Invalid query'.$conn->error);
    }

    if ($query->num_rows > 0) {
        // Mostra os dados de cada linha
        while($row = $query->fetch_assoc()) {
            $response = '<tr>';
            $response = $response.'<td>'.$row["id"].'</td>';
            $response = $response.'<td>'.$row["Nome"].'</td>';
            $response = $response.'<td>'.$row["Cargo"].'</td>';
            $response = $response.'<td>'.$row["Remuneracao"].'</td>';
            $response = $response.'<td><button id="maisinfo" class="btn btn-primary">+</button><td>';
            $response = $response.'</tr>';
            echo $response;//retorno
        }
        
      } else {
        echo "0 results";
      }
?> 