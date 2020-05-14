<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css/estilo-menu.css" rel="stylesheet">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Document</title>
    
    <script src="node_modules/jquery/dist/jquery.min.js"></script>

</head>

<body>
    <div class="container">

        <!-- Banner -->
        <div class="row align-items-center">
            <div class="col-md-5 text-right">
                <img class="img" src="imagens/mogi-logo.png" alt="" width="202px" height="202px" class="img-fluid">
            </div>

            <div id="transparencia" class="col-md-7">
                <h1>Tranparência</h1>
                <p>Deixando Mogi das Cruzes transparente para você</p>
            </div>

        </div>


        <!-- Menu Lateral-->
        <div class="row">
            <div id="menu" class="col-md-3 mr-2">
                <h4>Menu</h4>
                <hr>
                <ul>
                    <li>
                        <a href="#" class="menu-opcao" id="opcao1" alt="">Procurar Funcionários Publicos</a>
                    </li>
                    <li>
                        <a href="#" class="menu-opcao" id="opcao2" alt="">Comparar Funcionários Publicos</a>
                    </li>
                </ul>
            </div>

            <!-- Visualizaçao Principal (Exibição dos Servidores Públicos)-->
            <div class="col-md-8 text-center p-3" id="funcoes">
                <form id="formulario-pesquisa" method="post">

                    <p1>Mostrar:</p1>
                    <select id="controlalinhas"  name="qtdeLinhas" type="number"
                        title="quantidade de items a aparecer (quanto mais itens, mais lenta a página...)">
                        <option value=10>10</option>
                        <option value=25>25</option>
                        <option value=50>50</option>
                        <option value=100>100</option>
                    </select>

                    <p1>Buscar</p1>
                    <input id="busca" type="text">

                </form>

                <!-- Mostrar Gráfico -->

                <!-- Navegação Páginas da Tabela -->

                <!-- Tabela -->
                <table class="table striped" id="tabela-principal">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Funcionário</th>
                            <th scope="col">Cargo</th>
                            <th scope="col">Remuneração</th>
                            <th scope="col">*</th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody id="conteudo-tabela">
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    
    <footer id="footer">
        <div class="container">
            <div class="row align-items-end justify-content-center">
                <img id="fatec" class="img-fluid" src="./Imagens/fatec.png" alt="">
                <p>Desenvolvido pelos alunos da Fatec Mogi das Cruzes, orientados pelo professor Leandro Luke</p>
            </div>
        </div>
    </footer>

    <!-- Javascript -->
    <script src="main.js">
    </script>
    
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <scrip src="node_modules/@popperjs\core/dist/umd/popper.js"></scrip>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>


</body>

</html>