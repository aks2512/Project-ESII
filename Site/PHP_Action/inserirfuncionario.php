<?php

    $Nome = $_POST['Nome'];
    $Cargo = $_POST['Cargo'];
    $Modificado = $_POST['ModificadoEm'];
    $Regime = $_POST['Regime'];
    $Tbruto = $_POST['TBruto'];
    $Tliquido = $_POST['Tliquido'];

    $Tipodesconto = $_POST['Dtipo'];//4 Vetores com os numeros dos 4 inputs dos detalhes do funcionario
    $Tiporemuneracao = $_POST['Rtipo'];
    $Valordesconto = $_POST['Dval'];
    $Valorremuneracao = $_POST['Rval'];

    $OutrosDescontos = $_POST['OutrosDescontos'];
    $Remuneracao = 0.00;
    $Tdescontos = 0.00;

    $Tliquido=floatval(str_replace(',','.',$Tliquido));//Correção da digitação para interpretação do php (php usa sistema americano)
    $Tbruto=floatval(str_replace(',','.',$Tbruto));
    $OutrosDescontos=floatval(str_replace(',','.',$OutrosDescontos));

    $i = count($Tiporemuneracao)-1; //armazena tamanho da inserção para tabela remuneração
    $j = count($Tipodesconto)-1; //'' tabela descontos

    

    for($k=$i;$k>=0;$k--)//Gera Total da remuneração
    {
        $Valorremuneracao[$k] = floatval(str_replace(',','.',$Valorremuneracao[$k]));
        $Remuneracao = $Remuneracao + $Valorremuneracao[$k];
    }

    for($k=$j;$k>=0;$k--)//Gera Total 
    {
        $Valordesconto[$k] = floatval(str_replace(',','.',$Valordesconto[$k]));
        $Tdescontos = $Tdescontos + $Valordesconto[$k];
    }

    // Create connection
    $conn = mysqli_connect("localhost", "root", "", "transparenciamc");
    // Check connection
    if (!$conn) {
        die("Falha na conexao: " . mysqli_connect_error());
    }


    $DescontosObr = $Tdescontos;
    $Tdescontos = $DescontosObr + $OutrosDescontos; // Desconto Total terminado


    $sql = "INSERT INTO Funcionarios_BD " .
        "(id, Nome, Cargo, Remuneracao, Modificado, Regime, TBruto, Tliquido, TDescontos, DescontosObgr, OutrosDescontos) " .
        "VALUES" . "('NULL' , '$Nome', '$Cargo', '$Remuneracao', '$Modificado', '$Regime', '$Tbruto', '$Tliquido', '$Tdescontos', '$DescontosObr' , '$OutrosDescontos')";

    if (mysqli_query($conn, $sql)) {
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql = "SELECT * FROM Funcionarios_BD ORDER BY id DESC LIMIT 1";
    $query =  $conn->query($sql) or die($conn->errno .' - '. $conn->error);
    $row = $query->fetch_assoc();
    $id = $row["id"];

    while ($i >= 0) {//Vai Carregar cada linha relacionada a remuneração do funcionario

        $sql = "INSERT INTO detalhes (id,id_item, categoria,subcategoria, valor) VALUES ('$id','NULL', 'Remuneração','$Tiporemuneracao[$i]', '$Valorremuneracao[$i]')";

        if(!$sql)
        {
            echo "erro na inserção - ".$sqlcheck->err;
        }

        if (mysqli_query($conn, $sql)) {//Detecta erro e executa query
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }

        $i--;

    }


    while ($j >= 0) {//Vai Carregar cada linha relacionada aos descontos obrigatórios do funcionario
        $sql = "INSERT INTO detalhes (id,id_item, categoria,subcategoria, valor) VALUES ('$id','NULL', 'Desconto','$Tipodesconto[$j]', '$Valordesconto[$j]')";

        if(!$sql)
        {
            echo "erro na inserção";
        }

        if (mysqli_query($conn, $sql)) {//Detecta erro e executa query
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }

        $j--;

    }
    

    header('BD.php');

    mysqli_close($conn);

    $conn = null;
?>