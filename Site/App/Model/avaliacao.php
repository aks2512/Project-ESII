<?php

session_start();
$_SESSION['ip_user'] = $_SERVER['REMOTE_ADDR'];

try {
    $conn = getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn = getConnection();

    $sql = "UPDATE ja_votou (id_voto,IP_Remoto,Cod_projeto,Voto) VALUES (?,?,?,?) WHERE Codigo = " . $_SESSION['ip_user'] . $_GET['codigo'] . "'";
    $conn = $conn->prepare($sql);
    $conn->bindValue(1, $_SESSION['ip_user'] . $_GET['codigo']);
    $conn->bindValue(2, $_SESSION['ip_user']);
    $conn->bindValue(3, $_GET['codigo']);
    $conn->bindValue(4, "Positivo");
    $conn->execute();

    $conn = getConnection();

    $sql = "INSERT INTO ja_votou (id_voto,IP_Remoto,Cod_projeto,Voto)VALUES (?,?,?,?)";
    $conn = $conn->prepare($sql);
    $conn->bindValue(1, ($_SESSION['ip_user'] . $_GET['codigo']));
    $conn->bindValue(2, $_SESSION['ip_user']);
    $conn->bindValue(3, $_GET['codigo']);
    $conn->bindValue(4, "Positivo");
    $conn->execute();

    $conn = getConnection();

    if (isset($_GET['positivo'])) {

        $sql = "SELECT * FROM projeto_av WHERE Codigo = ?";
        $conn = $conn->prepare($sql);
        $conn->bindValue(1, $_GET['codigo']);
        $conn->execute();

        if ($conn->rowCount() > 0) {
            $resultado = $conn->fetchAll(\PDO::FETCH_ASSOC);
            echo $resultado;

            $conn = getConnection();

            $sql = "UPDATE projeto_av (Aprovacoes,Rejeicoes,TaxaAP) VALUES (?,?,?,?) WHERE Codigo = '" . $_GET['codigo'] . "'";
            $conn = $conn->prepare($sql);
            $conn->bindValue(1, $resultado['Aprovacoes'] + 1);
            $conn->bindValue(2, 0);
            $conn->bindValue(3, $resultado['Aprovacoes'] - $resultado['Rejeicoes']);
            $conn->execute();
        } else {
            $conn = getConnection();
            $sql = "INSERT INTO projeto_av (Codigo,Aprovacoes,Rejeicoes,TaxaAP) VALUES (?,?,?,?)";
            $conn = $conn->prepare($sql);
            $conn->bindValue(1, $_GET['codigo']);
            $conn->bindValue(2, 1);
            $conn->bindValue(3, 0);
            $conn->bindValue(4, 1);
            $conn->execute();
        }
    }
    if (isset($_GET['negativo'])) {
        echo "ok negativo/ip:" . $_SESSION['ip_user'] . " Codigo Projeto/" . $_GET['codigo'];
    }
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

function getConnection()
{
    $conn = new PDO('mysql:host=localhost;dbname=projectteste', 'root', '');
    return $conn;
}
