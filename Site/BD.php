<?php
    session_start();

    if(!isset($_SESSION["nome_usuario"])||!isset($_SESSION["id_admin"]))
    {
        header("location: login.php");
    }
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css/estilo-bd.css" rel="stylesheet">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <title>Document</title>
</head>

<body>
    <div id="site">
     <div class="col-md-12 controls margin-top-md" id="navegacaotopo">
     <div id="wherebutton"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Cadastrar Funcionário
                </button>
                <a href="PHP_Action/logoff.php" id="sair" class="btn-lg btn-danger">Sair</a>
                </div>
        <div>
            
        <div id="bodyBD" class="container">
            <div class="col-md-12">
                <div class="col-md-12 controls margin-top-md" id="navegacaoadmin">
                    <a class="btn-lg btn-success" href="pesquisaadmin.php">Procurar funcionario</a>
                </div>
                <form action="PHP_Action/inserirfuncionario.php" id="formulario-funcionarios" class="" method="POST">

                    <div id="titulo">
                        CADASTRAR FUNCIONÁRIOS NO SISTEMA
                    </div>

                    <div class="form-group">
                        <label>Nome</label>
                        <input id="inputbox" class="form-control" name="Nome">
                    </div>

                    <div class="form-group">
                        <label>Cargo</label>
                        <input id="inputbox" class="form-control" name="Cargo">
                    </div>

                    <div class="form-group">
                        <label>Data/Referência</label>
                        <input id="inputbox" class="form-control" name="ModificadoEm">
                    </div>

                    <div class="form-group">
                        <label>Regime</label>
                        <input id="inputbox" class="form-control" name="Regime">
                    </div>
                    <div class="form-group">
                        <label>Categorias de Remuneração</label>
                        <input class="form-control" placeholder="Digite Quantas categorias são" id="reqtde"></br>
                        <div id="reinput"></div>
                    </div>

                    <div class="form-group">
                        <label>Descontos Obrigatórios</label>
                        <input class="form-control" placeholder="Digite Quantas categorias são" id="deqtde"></br>
                        <div id="redescontos"></div>
                    </div>

                    <div class="form-group">
                        <label>Outros Descontos</label>
                        <input id="inputbox" class="form-control" name="OutrosDescontos">
                    </div>

                    <div id="button-holder">
                        <button class="btn btn-primary" id="botao" type="submit">Atualizar</button>
                    </div>
                </form>
                <div id="errmsg"></div>
                <div id="okmsg"></div>
            </div>
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


    <script src="scriptJS/extensaobd.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>

</body>

</html>