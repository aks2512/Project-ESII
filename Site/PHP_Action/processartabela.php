<?php

    $busca = $_POST['busca'];
    $limite = $_POST['qtde'];

    //conexão com banco de dados
    include "conexao.php";
    

    //obs: a variavel $busca está entre aspas simples pois deve ser analisada como valor e não como coluna
    $sql = "SELECT id,nome,cargo,tbruto FROM funcionarios WHERE nome LIKE '%$busca%' or cargo LIKE '%$busca%' or id = '$busca' or tbruto LIKE '%$busca%' LIMIT $limite";

    $query =  $conn->query($sql);
    

    if(!$query){//Detecta erro da query
        trigger_error('Invalid query'.$conn->error);
    }
    if(!isset($_POST["tabela"]))
    {
        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()) {
                $response = '<tr>';
                $response = $response.'<td>'.$row["id"].'</td>';
                $response = $response.'<td>'.$row["nome"].'</td>';
                $response = $response.'<td>'.$row["cargo"].'</td>';
                $response = $response.'<td>'.$row["tbruto"].'</td>';
                $response = $response.'<td><button value="'.$row["id"].'" data-toggle="modal"  class="btn btn-primary view-data">+</button><td>';
                $response = $response.'</tr>';
                echo $response;//retorno
            }
        }
        else
        {
            echo "Nenhum resultado encontrado...";
        }
    }
    else
    {
        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()) {
                $response = '<tr>';
                $response = $response.'<td><input value="'.$row["id"].'" type="checkbox" name="funcionario"></td>';
                $response = $response.'<td>'.$row["id"].'</td>';
                $response = $response.'<td>'.$row["nome"].'</td>';
                $response = $response.'<td>'.$row["cargo"].'</td>';
                $response = $response.'<td>'.$row["tbruto"].'</td>';
                $response = $response.'<td><button value="'.$row["id"].'" data-toggle="modal" class="btn btn-primary view-data">+</button><td>';
                $response = $response.'</tr>';
                echo $response;//retorno
            }
        }
        else
        {
            echo "Nenhum resultado encontrado...";
        }
    }
?> 