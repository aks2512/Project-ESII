<?php
    session_start();

    if(isset($_SESSION["nome_usuario"])||isset($_SESSION["id_admin"]))
    {
        header("location: BD.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css/estilo-adm.css" rel="stylesheet">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <title>Login</title>
</head>

<body>
    <div id="banner" class="img-fluid">
    <div id="wherebutton"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Cadastrar Funcionário
</button></div>
            <div class="row justify-content-center text-center">
                <div class="col-md-12">
                    <img class="img-fluid" src="imagens/mogi-logo.png" id="imagemcomdesvio" alt="">
                </div>
                <div class="col-md-3" id="corpoformulario">
                    <form method="POST" id="formulariologin" action="PHP_Action/checarlogin.php"> 

                        <div class="form-group" id="formalinhado">
                            <label for="Usuario">Usuário:</label>
                            <input name="Usuario" type="text" class="form-control" id="inputbox" placeholder="usuario" maxlength="32">
                        </div>

                        <div class="form-group">
                            <label for="Senha">Senha:</label>
                            <input name="Senha" type="password" class="form-control" id="inputbox" placeholder="senha" maxlength="22">
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" name="btn-login" id="botaoentrar" class="btn btn-success" value="ACESSAR">Entrar</button>
                        </div>
                    </form>
                    <div id="okmsg"></div>
                    <div id="errmsg"></div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Administrador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formcadastro"method="POST" action="PHP_Action/inserirusuario.php"> 

        <div class="form-group" id="formalinhado">
            <label for="Usuario">Usuário:</label>
            <input name="Usuariocadastro" type="text" class="form-control" id="inputbox2" placeholder="usuario" maxlength="32">
        </div>

        <div class="form-group">
            <label for="Senha">Senha:</label>
            <input name="Senhacadastro" type="password" class="form-control" id="inputbox2" placeholder="senha" maxlength="22">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" id="cadastrar" class="btn btn-success">Cadastrar</button>
        </form>
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
    <script src="login.js"></script>
</body>

</html>