<?php

    require_once 'vendor/autoload.php';

    $funcionario = new \App\Model\FuncionarioCamara();
    $funcionario->setCargo($_POST['cargo']);
    $funcionario->setVencimento_Base(floatval($_POST['vencimento_base']));
    $funcionario->setOutros_Vencimentos(floatval($_POST['outros_vencimentos']));
    $funcionario->setPrevidencia(floatval($_POST['previdencia']));
    $funcionario->setOutrosDescontos(floatval($_POST['outros_descontos']));
    $funcionario->setTBruto(floatval($_POST['tbruto']));
    $funcionario->setTDesconto(floatval($_POST['tdesconto']));
    $funcionario->setIRRF(floatval($_POST['irrf']));
    $funcionario->setTLiquido();
    $funcionario->setRgf($_POST['btn-atualizar']);

    $funcionarioDao = new \App\Model\FuncionarioCamaraDao();
    $funcionarioDao->update($funcionario);

    header('Location: administracao.php?p=funcionariosCamara');
    exit;

?>