<?php

require_once 'vendor/autoload.php';

$remuneracoes = new ArrayObject();
$remQtd = (int)$_POST['remQtd'];

if($remQtd != 0){
    for($i = 0; $i<$remQtd; $i++){
        $remuneracao = new \App\Model\Remuneracao();
        $remuneracao->setNome($_POST['TR'.$i.'']);
        $remuneracao->setValor(floatval($_POST['VR'.$i.'']));
    
        $remuneracoes->append($remuneracao);
    }
}

$descontos = new ArrayObject();
$desQtd = $_POST['desQtd'];

if($desQtd != 0){
    for($i = 0; $i<$desQtd; $i++){
        $desconto = new \App\Model\Remuneracao();
        $desconto->setNome($_POST['TD'.$i.'']);
        $desconto->setValor(floatval($_POST['VD'.$i.'']));
    
        $descontos->append($desconto);
    }
}

$funcionario = new \App\Model\FuncionarioPrefeitura();
$funcionario->setRgf($_POST['Rgf']);
$funcionario->setNome($_POST['Nome']);
$funcionario->setCargo($_POST['Cargo']);
$funcionario->setRegime($_POST['Regime']);
$funcionario->setRemuneracoes($remuneracoes);
$funcionario->setDescontos($descontos);
$funcionario->setOutrosDescontos($_POST['OutrosDescontos']);
$funcionario->setTBruto();
$funcionario->setTDesconto();
$funcionario->setTLiquido();

$funcionarioDao = new \App\Model\FuncionarioPrefeituraDao();
$funcionarioDao->create($funcionario);

// header('Location: administracao.php');
// exit;

?>