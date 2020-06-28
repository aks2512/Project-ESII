<?php
    session_start();

    $erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
    $signout = isset($_GET['signout']) ? $_GET['signout'] : 0;

    if($signout == 1){
        $_SESSION['usuario'] = NULL;
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css/estilo-adm.css" rel="stylesheet">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <title>Login</title>
</head>

<body>
    <div id="banner" class="img-fluid">
            <div class="row justify-content-center text-center">
                <div class="col-md-12">
                    <img class="img-fluid" src="imagens/mogi-logo.png" id="imagemcomdesvio" alt="">
                </div>
                <div class="col-md-3" id="corpoformulario">
                    <form method="POST" id="formulariologin" action="validarLogin.php"> 

                        <div class="form-group" id="formalinhado">
                            <label for="Usuario">Usuário:</label>
                            <input id="Usuario" name="Usuario" type="text" class="form-control" placeholder="usuario" maxlength="32" required="required">
                        </div>

                        <div class="form-group">
                            <label for="Senha">Senha:</label>
                            <input id="Senha" name="Senha" type="password" class="form-control" placeholder="senha" maxlength="22" >
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" name="btn-login" id="botaoentrar" class="btn btn-success">Entrar</button>
                        </div>
                    </form>
                        <?php

                            if($erro == 1){
                                $mensagemErro = "Login ou Senha Inválidos";
                                echo '
                                    <div>
                                        <span class="text-danger">'.$mensagemErro.'</span>
                                    </div>    
                                ';
                            }

                        ?>
                </div>
            </div>
        </div>
    </div>
    
    
    <footer id="footer" class="footer-fixed-bottom">
        <div class="container">
            <div class="row align-items-end justify-content-center">
                <img id="fatec" class="img-fluid" src="./Imagens/fatec.png" alt="">
                <p>Desenvolvido pelos alunos da Fatec Mogi das Cruzes, orientados pelo professor Leandro Luque</p>
            </div>
        </div>
    </footer>



    <scrip src="node_modules/@popperjs\core/dist/umd/popper.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>