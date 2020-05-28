<?php 
    //cria coneção com o banco de dados

    // Create connection
    $conn = mysqli_connect("localhost", "root", "", "transparenciamc");
    mysqli_set_charset($conn, 'utf8');
    // Check connection
    if (!$conn) {
        die("Falha na conexao: " . mysqli_connect_error());
    }

?>