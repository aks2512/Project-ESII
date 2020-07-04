<?php

    require_once 'vendor/autoload.php';
    
    $remuneracoes = new ArrayObject();

    $nomesR = array_filter($_POST['nomesR']);
    $valoresR = array_filter($_POST['valoresR']);
    $rem_id_item = array_filter($_POST['rem_id_item']);
    $delete_rem = array_filter($_POST['delete_rem']);

    if($nomesR != NULL){
        foreach ($nomesR as $key => $nome) {
            $remuneracao = new \App\Model\Remuneracao();
            $remuneracao->setNome($nome);
            $remuneracao->setValor(floatval($valoresR[$key]));
            $remuneracao->setId(isset($rem_id_item[$key]) ? $rem_id_item[$key] : NULL);
            $remuneracao->setDelete(isset($delete_rem[$key]) ? $delete_rem[$key] :"false");    
    
            $remuneracoes->append($remuneracao);
        }
    }


    $descontos = new ArrayObject();

    $nomesD = array_filter($_POST['nomesD']);
    $valoresD = array_filter($_POST['valoresD']);
    $des_id_item = array_filter($_POST['des_id_item']);
    $delete_des = array_filter($_POST['delete_des']);

    if($nomesD != NULL){
        foreach ($nomesD as $key => $nome) {
            $desconto = new \App\Model\Desconto();
            $desconto->setNome($nome);
            $desconto->setValor(floatval($valoresD[$key]));
            $desconto->setId(isset($des_id_item[$key]) ? $des_id_item[$key] : NULL);
            $desconto->setDelete(isset($delete_des[$key]) ? $delete_des[$key] : "false");
    
            $descontos->append($desconto);
        }
    }

    $funcionario = new \App\Model\FuncionarioPrefeitura();
    $funcionario->setCargo($_POST['cargo']);
    $funcionario->setRegime($_POST['regime']);
    $funcionario->setRemuneracoes($remuneracoes);
    $funcionario->setDescontos($descontos);
    $funcionario->setOutrosDescontos($_POST['outros_descontos']);
    $funcionario->setTBruto();
    $funcionario->setTDesconto();
    $funcionario->setTLiquido();
    $funcionario->setRgf($_POST['btn-atualizar']);

    $funcionarioDao = new \App\Model\FuncionarioPrefeituraDao();
    $funcionarioDao->update($funcionario);

    header('Location: administracao.php');
    exit;


?>