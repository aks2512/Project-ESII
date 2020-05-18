<?php

session_start();
// Essa inserção é apenas para teste
header('Content-Type: application/json');
require "conexao.php";

$nome = mysqli_real_escape_string($conn,$_POST['Usuariocadastro']);
$senha = md5($_POST['Senhacadastro']);

//$ip = (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';//verifica ip real da máquina

//$servidores = array(
//    'localhost'=>'127.0.0.1',
//);

//$resultado = array_search($servidores,$ip);
$sql = "SELECT Usuario FROM administradores WHERE '$nome' = Usuario LIMIT 1";

$query =  $conn->query($sql);

if(($query->num_rows)>0)
{
    $erro = utf8_encode("Usuário com mesmo nome já existe!");
    $contexto = array('mensagem'=>$erro,'codigo'=>0);
    echo json_encode($contexto);
    return;
}

$sql = "INSERT INTO administradores (id_admin,Usuario, Senha)VALUES(NULL, '$nome', '$senha')";

if(!$sql)
{
    $erro = $sqlcheck->err;
    $contexto = array('mensagem'=>$erro,'codigo'=>0);
    echo json_encode($contexto);
    return;
}
if (mysqli_query($conn, $sql))
{
    $erro = "";
    $contexto = array('mensagem'=>$erro,'codigo'=>1);
    echo json_encode($contexto);
} else {
    $erro = $sql."<br>".mysqli_error($conn);
    $contexto = array('mensagem'=>$erro,'codigo'=>0);
    echo json_encode($contexto);
}

header("location: ../login.php")

?>