<?php
    $Nome = $_POST['Nome'];
    $Cargo = $_POST['Cargo'];
    $Modificado = $_POST['ModificadoEm'];
    $Regime = $_POST['Regime'];
    $Tbruto = $_POST['TBruto'];
    $Tliquido = $_POST['Tliquido'];

    $Tipodesconto = $_POST['Dtipo'];
    $Tiporemuneracao = $_POST['Rtipo'];
    $Valordesconto = $_POST['Dval'];
    $Valorremuneracao = $_POST['Rval'];

    $OutrosDescontos = $_POST['OutrosDescontos'];
    $Remuneracao = 0.00;
    $Tdescontos = 0.00;


    $i = count($Tiporemuneracao)-1; //armazena tamanho da inserção para tabela remuneração
    $j = count($Tipodesconto)-1; //'' tabela descontos

    for($k=$i;$k>=0;$k--)
    {
        $Remuneracao = $Remuneracao + str_replace(',','.',$Valorremuneracao[$k]) ;
    }

    echo $Remuneracao;

    for($k=$i;$k>=0;$k--)
    {
        $Tdescontos = $Tdescontos + str_replace(',','.',$Valordesconto[$k]);
    }
    echo "-".$Tdescontos;
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
        header('BD.php?q=2');
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        header('BD.php?q=1');
    }

    while ($i >= 0) {
        "INSERT INTO detalhes (id, categoria,subcategoria, valor) VALUES ('NULL', 'Remuneração','$Tiporemuneracao[$i]', '$Valorremuneracao[$i]')";
        $i--;
    }

    while ($j >= 0) {
        "INSERT INTO detalhes (id, categoria,subcategoria, valor) VALUES ('NULL', 'Desconto','$Tipodesconto[$j]', '$Valordesconto[$j]')";

        $j--;
    }

    header('BD.php');

    mysqli_close($conn);

    $conn = null;
?>