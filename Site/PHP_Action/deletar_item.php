<?php
    //deleta o funcionario do banco de dados
    include "conexao.php";

    $id = $_POST['id'];

    $sql = "SELECT id,valor,categoria FROM detalhes WHERE '$id'= id_item";
    $query = $conn->query($sql);

    if($query->num_rows > 0)
    {
        while($row = $query->fetch_assoc())
        {
            $id_funcionario = $row['id'];
            $valor = $row['valor'];
            $categoria = $row['categoria'];
        }
    }

    $sql = "SELECT TBruto,Tliquido,TotalDescontos,DescontosObrigatorios FROM funcionarios_bd WHERE id = '$id_funcionario'";
    $query = $conn->query($sql);

    if($query->num_rows > 0)
    {
        while($row = $query->fetch_assoc())
        {
            $TBruto = $row['TBruto'];
            $Tliquido = $row['Tliquido'];
            $TotalDescontos = $row['TotalDescontos'];
            $DescontosObrigatorios = $row['DescontosObrigatorios'];
        }
    }

    if($categoria=="Remuneracao")
    {
        $TBruto = $TBruto - $valor;
        $Tliquido = $Tliquido-$valor;
    }
    

    if($categoria=="Desconto")
    {
        $TotalDescontos = $TotalDescontos - $valor;
        $DescontosObrigatorios = $DescontosObrigatorios - $valor;
        $Tliquido = $Tliquido + $valor;
        $TBruto = $TBruto + $valor;
    }

    $sql = "UPDATE funcionarios_bd SET TDescontos='$TotalDescontos' DescontosObgr='$DescontosObrigatorios' Tliquido='$Tliquido' TBruto='$TBruto' ";

        if (mysqli_query($conn, $sql)) {
        } else {
            echo utf8_encode("Erro: " . $sql . "<br>" . mysqli_error($conn));
            return;
        }
      
    $sql = "DELETE FROM detalhes WHERE '$id' = id_item";

        if (mysqli_query($conn, $sql)) {
        } else {
            echo utf8_encode("Erro: " . $sql . "<br>" . mysqli_error($conn));
            return;
        }

?>