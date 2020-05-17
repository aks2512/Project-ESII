<?php
	session_start();	
    include("conexao.php");	
    
    $login = isset($_POST['Usuario']) ? addslashes(trim($_POST['Usuario'])) : FALSE; 
    // Recupera a senha, a criptografando em MD5 
    $senha = isset($_POST['Senha']) ? md5(trim($_POST['Senha'])) : FALSE; 

    if(!$login||!$senha)
    {
        $erro = "Preencha todos os campos!";
        $contexto = array('mensagem'=>$erro,'codigo'=>0);
        echo (json_encode($contexto));
    }

    $sql = "SELECT * FROM administradores WHERE Senha = '$senha' and Usuario = '$login' ";

    if (mysqli_query($conn, $sql)) {
    } else {
        $erro = $sql."<br>".mysqli_error($conn);
        $contexto = array('mensagem'=>$erro,'codigo'=>0);
        echo (json_encode($contexto));//Ajax coleta echo como retorno
    }
     
    $query = mysqli_query($conn,$sql);
    $total = mysqli_num_rows($query);

    if($total)
    {

        $dados = mysqli_fetch_array($query);

        if(!strcmp($senha,$dados["Senha"]))
        {
            $_SESSION["id_admin"]=$dados["id_admin"];
            $_SESSION["nome_usuario"] = stripslashes($dados["Usuario"]);
            header("Location: ../BD.php");  
        }
    }
    else
    {
        $erro = utf8_encode("Usuário e/ou senha não existem!");
        $contexto = array("mensagem"=>$erro,"codigo"=>"0");
        echo (json_encode($contexto));
    }
?>