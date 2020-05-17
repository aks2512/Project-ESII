<?php
    session_start();

    if(!isset($_SESSION["nome_usuario"])||!isset($_SESSION["id_admin"]))
    {
        header("location: login.php?q=1");
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
     <div class="col-sm-12 controls margin-top-md">
                <a href="PHP_Action/logoff.php" id="sair" class="btn-lg btn-danger">Sair</a>
                </div>
        <div id="bodyBD" class="container">
            <div class="col-md-12">
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
                        <label>Total Bruto</label>
                        <input id="inputbox" class="form-control" name="TBruto">
                    </div>

                    <div class="form-group">
                        <label>Total Liquído</label>
                        <input id="inputbox" class="form-control" name="Tliquido">
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

    <footer id="footer" class="footer-fixed-bottom">
        <div class="container">
            <div class="row align-items-end justify-content-center">
                <img id="fatec" class="img-fluid" src="./Imagens/fatec.png" alt="">
                <p>Desenvolvido pelos alunos da Fatec Mogi das Cruzes, orientados pelo professor Leandro Luque</p>
            </div>
        </div>
    </footer>


    <script src="extensaobd.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>

</body>

</html>