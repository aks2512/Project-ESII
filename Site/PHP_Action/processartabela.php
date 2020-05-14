<?php

    $busca = $_POST['busca'];

    //conexão com banco de dados
    $conn = new mysqli("localhost", "root", "", "transparenciamc");
    if( $conn ->connect_error) {
    exit('Erro na conexao');
    }
    

    //obs: a variavel $busca está entre aspas simples pois deve ser analisada como valor e não como coluna
    $sql = "SELECT id,Nome,Cargo,Remuneracao FROM funcionarios_bd WHERE Nome LIKE '%$busca%' or Cargo LIKE '%$busca%' or id LIKE '%$busca' or Remuneracao LIKE '%$busca%'";

    $query =  $conn->query($sql);
    

    if(!$query){//Detecta erro da query
        trigger_error('Invalid query'.$conn->error);
    }
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()) {
            $response = '<tr>';
            $response = $response.'<td>'.$row["id"].'</td>';
            $response = $response.'<td>'.$row["Nome"].'</td>';
            $response = $response.'<td>'.$row["Cargo"].'</td>';
            $response = $response.'<td>'.$row["Remuneracao"].'</td>';
            $response = $response.'<td><button id="maisinfo" value="'.$row["id"].'"" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">+</button><td>';
            $response = $response.'</tr>';
            echo $response;//retorno
        }
    }
    else
    {
        echo "Nenhum resultado encontrado...";
    }
?> 