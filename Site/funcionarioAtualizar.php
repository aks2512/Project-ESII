<?php

    require_once 'vendor/autoload.php';
    
    $remuneracoes = new ArrayObject();

    $nomesR = array_filter($_POST['nomesR']);
    $valoresR = array_filter($_POST['valoresR']);
    $rem_id_item = array_filter($_POST['rem_id_item']);
    $delete_rem = array_filter($_POST['delete_rem']);

    foreach ($nomesR as $key => $nome) {
        $remuneracao = new \App\Model\Remuneracao();
        $remuneracao->setNome($nome);
        $remuneracao->setValor(floatval($valoresR[$key]));
        $remuneracao->setId(isset($rem_id_item[$key]) ? $rem_id_item[$key] : NULL);
        $remuneracao->setDelete(isset($delete_rem[$key]) ? $delete_rem[$key] :"false");

        echo $remuneracao->getNome().'<br>';
        echo $remuneracao->getvalor().'<br>';
        echo $remuneracao->getId().'<br>';
        echo $remuneracao->getDelete().'<br><br>';       

        $remuneracoes->append($remuneracao);
    }


    $descontos = new ArrayObject();

    $nomesD = array_filter($_POST['nomesD']);
    $valoresD = array_filter($_POST['valoresD']);
    $des_id_item = array_filter($_POST['des_id_item']);
    $delete_des = array_filter($_POST['delete_des']);

    foreach ($nomesD as $key => $nome) {
        $desconto = new \App\Model\Desconto();
        $desconto->setNome($nome);
        $desconto->setValor(floatval($valoresD[$key]));
        $desconto->setId(isset($des_id_item[$key]) ? $des_id_item[$key] : NULL);
        $desconto->setDelete(isset($delete_des[$key]) ? $delete_des[$key] : "false");

        echo $desconto->getNome().'<br>';
        echo $desconto->getvalor().'<br>';
        echo $desconto->getId().'<br>';
        echo $desconto->getDelete().'<br><br>';

        $descontos->append($desconto);
    }

    $funcionario = new \App\Model\Funcionario();
    $funcionario->setCargo($_POST['cargo']);
    $funcionario->setRegime($_POST['regime']);
    $funcionario->setRemuneracoes($remuneracoes);
    $funcionario->setDescontos($descontos);
    $funcionario->setOutrosDescontos($_POST['outros_descontos']);
    $funcionario->setTBruto();
    $funcionario->setTDescontos();
    $funcionario->setTLiquido();
    $funcionario->setRgf($_POST['btn-atualizar']);

    $funcionarioDao = new \App\Model\FuncionarioDao();
    $funcionarioDao->update($funcionario);

    header('Location: administracao.php');
    exit;


?>