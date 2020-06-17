<?php
    // verifica se o usuario é um usuario valido no sistema

    session_start();	
    header('Content-Type: application/json');
    include("conexao.php");

    if(isset($_SERVER["HTTP_REFEREER"])&& $_SERVER["HTTP_REFEREER"] != "http://localhost/project-ESII/Site/login.php")
        {
            $erro = utf8_encode("Endereço do referente inválido!");
            $contexto = array('mensagem'=>$erro,'codigo'=>1);
            echo (json_encode($contexto));
            exit();
        }
    
    $login = isset($_POST['Usuario']) ? addslashes(trim($_POST['Usuario'])) : FALSE; 
    // Recupera a senha, a criptografando em MD5 
    $senha = isset($_POST['Senha']) ? md5(trim($_POST['Senha'])) : FALSE; 

    $sql = "SELECT * FROM administrador WHERE senha = '$senha' and usuario = '$login' ";

    if (mysqli_query($conn, $sql)) {
    } else {
        $contexto = array('mensagem'=>$sql."<br>".mysqli_error($conn),'codigo'=>1);
        echo (json_encode($contexto));//Ajax coleta echo como retorno
        exit();
    }
     
    $query = mysqli_query($conn,$sql);
    $total = mysqli_num_rows($query);

    if($total>0)
    {

        $dados = mysqli_fetch_array($query);

        if(!strcmp($senha,$dados["senha"]))
        {
            $_SESSION["id_admin"]=$dados["id_admin"];
            $_SESSION["nome_usuario"] = stripslashes($dados["Usuario"]);
            $erro = "";
            $contexto = array('mensagem'=>$erro,'codigo'=>0);
            echo (json_encode($contexto));
            header("Location: ../adminstracao.php");
            exit();
        }
    }
    else
    {
        $erro = "Usuario e ou senha nao existem";
        $contexto = array('mensagem'=>$erro,'codigo'=>1);
        echo json_encode($contexto);
        exit();
    }
    
?>