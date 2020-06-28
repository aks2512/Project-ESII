<?php
        require_once 'vendor/autoload.php';

        $id = $_POST['id'];

        $i = count($id)-1;

        while($i>=0)
        {
            $comp = $id[$i];
            $funcionarioDao = new \App\Model\FuncionarioPrefeituraDao();
            $funcionarioDao->delete($comp);
            $i--;
        }

?>