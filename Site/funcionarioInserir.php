<?php

require_once 'vendor/autoload.php';

$remuneracoes = new ArrayObject();
$remQtd = (int)$_POST['remQtd'];

for($i = 0; $i<$remQtd; $i++){
    $remuneracao = new \App\Model\Remuneracao();
    $remuneracao->setNome($_POST['TR'.$i.'']);
    $remuneracao->setValor(floatval($_POST['VR'.$i.'']));

    $remuneracoes->append($remuneracao);
}

$descontos = new ArrayObject();
$desQtd = $_POST['desQtd'];

for($i = 0; $i<$desQtd; $i++){
    $desconto = new \App\Model\Remuneracao();
    $desconto->setNome($_POST['TD'.$i.'']);
    $desconto->setValor(floatval($_POST['VD'.$i.'']));

    $descontos->append($desconto);
}

$funcionario = new \App\Model\Funcionario();
$funcionario->setRgf($_POST['Rgf']);
$funcionario->setNome($_POST['Nome']);
$funcionario->setCargo($_POST['Cargo']);
$funcionario->setRegime($_POST['Regime']);
$funcionario->setRemuneracoes($remuneracoes);
$funcionario->setDescontos($descontos);
$funcionario->setOutrosDescontos($_POST['OutrosDescontos']);
$funcionario->setTBruto();
$funcionario->setTDescontos();
$funcionario->setTLiquido();

$funcionarioDao = new \App\Model\FuncionarioDao();
$funcionarioDao->create($funcionario);

header('Location: administracao.php');
exit;

?>