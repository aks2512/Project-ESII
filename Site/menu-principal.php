<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css/estilo-menu.css" rel="stylesheet">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Document</title>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

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

                    <p1>Filtro:</p1>
                    <select name="Filtro" id="filtro" title="O filtro escolhe a coluna qual você vai pesquisar">
                        <option value="Nome">Nome</option>
                        <option value="Remuneracao">Remuneração</option>
                        <option value="Cargo">Cargo</option>
                    </select>

                    <p1>Buscar</p1>
                    <input id="busca" type="text">

                    <input class="Buscar" type="button"  title="Iniciar pesquisa">

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

    <script>
        $(document).ready(function(){
            $('.Buscar').click(function(){
                var filtro = document.getElementById('filtro').value;
                var linhas = document.getElementById('controlalinhas').value;
                var busca = document.getElementById('busca').value;
                $.ajax({
                type:"POST",
                url: "processartabela.php",
                data: {'filtro': filtro, 'linhas': linhas,'busca': busca},
                success: function(dados){
                document.getElementById('conteudo-tabela').innerHTML = dados;
            }
        });
            });
        });
    </script>

    <!-- ajax -->
    <script>
        $(document).ready(function () {
            $('.menu-opcao').click(function () {
                var carrega_url = this.id;
                carrega_url = carrega_url + '_conteudo.html';

                $.ajax({
                    url: carrega_url,

                    success: function (data) {
                        $('#funcoes').html(data);
                    }

                });
            });
        });

    </script>
    
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <scrip src="node_modules/@popperjs\core/dist/umd/popper.js"></scrip>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>


</body>

</html>