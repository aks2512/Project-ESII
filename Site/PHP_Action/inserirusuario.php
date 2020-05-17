<?php

// Essa inserção é apenas para teste

require "conexao.php";

$nome = mysqli_real_escape_string($conn,$_POST['Usuariocadastro']);
$senha = md5($_POST['Senha']);

//$ip = (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';//verifica ip real da máquina

//$servidores = array(
//    'localhost'=>'127.0.0.1',
//);

//$resultado = array_search($servidores,$ip);



$sql = "INSERT INTO administradores (id_admin,Usuario, Senha)VALUES(NULL, '$nome', '$senha')";

if(!$sql)
{
    $erro = $sqlcheck->err;
    $contexto = array('mensagem'=>$erro,'codigo'=>0);
    json_encode($contexto);
    exit;
}

if (mysqli_query($conn, $sql)) {//Detecta erro e executa query
} else {
    $erro = $sql."<br>".mysqli_error($conn);
    $contexto = array('mensagem'=>$erro,'codigo'=>0);
    json_encode($contexto);
    exit;
}

header("location: ../login.php")

?>