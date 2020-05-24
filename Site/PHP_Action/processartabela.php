<?php
    session_start();

    $busca = $_POST['busca'];

    //conexão com banco de dados
    include "conexao.php";
    

    //obs: a variavel $busca está entre aspas simples pois deve ser analisada como valor e não como coluna
    $sql = "SELECT id,Nome,Cargo,TBruto FROM funcionarios_bd WHERE Nome LIKE '%$busca%' or Cargo LIKE '%$busca%' or id LIKE '%$busca' or TBruto LIKE '%$busca%'";

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
                $response = $response.'<td>'.$row["Nome"].'</td>';
                $response = $response.'<td>'.$row["Cargo"].'</td>';
                $response = $response.'<td>'.$row["TBruto"].'</td>';
                $response = $response.'<td><button id="'.$row["id"].'" value="'.$row["id"].'" data-toggle="modal"  class="btn btn-primary view-data">+</button><td>';
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
                $response = $response.'<td>'.$row["Nome"].'</td>';
                $response = $response.'<td>'.$row["Cargo"].'</td>';
                $response = $response.'<td>'.$row["TBruto"].'</td>';
                $response = $response.'<td><button id="'.$row["id"].'" value="'.$row["id"].'" data-toggle="modal" class="btn btn-primary view-data">+</button><td>';
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