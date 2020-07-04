<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css/estilo-adm.css" rel="stylesheet">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <title>Cadastro</title>
</head>

<body>
    <div id="banner" class="img-fluid">
            <div class="row justify-content-center text-center">
                <div class="col-md-12">
                    <img class="img-fluid" src="imagens/mogi-logo.png" id="imagemcomdesvio" alt="">
                </div>
                <div class="bg-white rounded col-md-3" id="corpoformulario">
                    <h3 class="my-2">Cadastrar Administrador</h3>
                    <form method="POST" id="formulariocadastro" action="administradorInserir.php"> 

                        <div class="form-group" id="formalinhado">
                            <label for="Usuario"><strong>Usuário:</strong></label>
                            <input name="Usuario" id="Usuario" type="text" class="form-control" placeholder="usuario" maxlength="32" required="required">
                        </div>

                        <div class="form-group">
                            <label for="Senha"><strong>Senha:</strong></label>
                            <input name="Senha" id="Senha" type="password" class="form-control" placeholder="senha" maxlength="22" required="required">
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" name="btn-cadastro" id="botaocadastrar" class="btn btn-success">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <scrip src="node_modules/@popperjs\core/dist/umd/popper.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="scriptJS/login.js"></script>
</body>

</html>