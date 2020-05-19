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

            <!-- Visualizaçao Principal (Exibição dos Servidores Públicos)-->
            <div class="col-md-12 text-center " id="funcoes">
                <div class="row justify-content-center">
                  <h3 id="title-h3">Servidores Públicos</h3>
                  <p id="p-text" class="col-md-10 text-left">
                    Gastos com servidores públicos, dentro dos limites estabelecidos pela Lei de Responsabilidade
                    Fiscal, podem ser verificados e acompanhados periodicamente.
                  </p>
                </div>

                <!-- Barra Pesquisa -->
                <form id="formulario-pesquisa" method="post" class="col-md-10">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="row justify-content-center align-end">
                        <p class="p-form col-md-3 mr-2">Mostrar</p>
                        <select class="col-md-3" id="controlalinhas" name="qtdeLinhas" type="number" title="quantidade de items a aparecer (quanto mais itens, mais lenta a página...)">
                          <option value=10>10</option>
                          <option value=25>25</option>
                          <option value=50>50</option>
                          <option value=100>100</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="row justify-content-center align-center">
                        <p class="p-form mr-2 col-md-1">Buscar</p>
                        <input class="col-md-9" id="busca" type="text">
                      </div>
                    </div>

                  </div>
                </form>

                <!-- Mostrar Gráfico e Paginas-->
                <div class="row justify-content-center mt-5">
                  <div class="col-md-6 text-right"><!-- Mostrar Gráfico -->
                    <a id="btn-grafico" class="btn btn-default" href="">Mostrar Gráfico</a>
                  </div><!-- Navegação Páginas da Tabela -->
                  <div class="col-md-6">
                    <nav aria-label="...">
                      <ul class="pagination">
                        <li class="page-item disabled">
                          <span class="page-link">Anterior</span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active" aria-current="page">
                          <span class="page-link">
                            2
                            <span class="sr-only">(current)</span>
                          </span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                          <a class="page-link" href="#">Proximo</a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>

                <!-- Tabela -->
                <div class="container">
                  <div class="row justify-content-center">
                    <table class="table striped col-md-10" id="tabela-principal">
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
                <!-- nº Registros e Paginação -->
                <div class="row">
                  <div class="col-md-6 text-center">
                    <p>1 até 10 de 5,691 registros</p>
                  </div>
                  <div class="col-md-6">
                    <nav aria-label="...">
                      <ul class="pagination">
                        <li class="page-item disabled">
                          <span class="page-link">Anterior</span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active" aria-current="page">
                          <span class="page-link">
                            2
                            <span class="sr-only">(current)</span>
                          </span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                          <a class="page-link" href="#">Proximo</a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
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


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-color">
        <div class="row justify-content-end">
          <img src="Imagens/usuario.png" alt="" class="col-md-2">
          <h5 class="modal-title col-md-9" id="exampleModalLabel">Jefferson Akira Fukamizu</h5>
          <button type="button" class="close col-md-1" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </div>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-left">
            <p class="bold">Cargo:<br>
              Aux Administrativo</p>
          </div>
          <div class="col-md-12 text-left">
            <p class="bold">Referência:<br>
              Fev/2020</p>
          </div>
          <div class="col-md-12 text-left">
            <p class="bold">Total Bruto:<br>
              1418,99</p>
          </div>
          <div class="col-md-12 text-left">
            <p class="bold">Total Liquido:<br>
              1418,99</p>
          </div>
          <div class="col-md-12 text-left">
            <p class="bold">Total de Descontos:<br>
              0</p>
          </div>
        </div>
        <div>
          <div class="row">
            <div class="col-md-12 text-left">
              <p>Remuneração</p>
              <hr>
              <div class="row">
                <div class="col-md-6 text-left">
                  <p>VENCIMENTO</p>
                </div>
                <div class="col-md-6 text-left">
                  <p>1642,97</p>
                </div>
              </div>
            </div>
            <div class="col-md-12 text-left">
              <p>Descontos Obrigatorios:</p>
              <hr>
              <div class="row">
                <div class="col-md-6 text-left">
                  <p>IPREM</p>
                </div>
                <div class="col-md-6 text-left">
                  <p>180,73</p>
                </div>
              </div>
            </div>
            <div class="col-md-12 text-left">
              <p>Outros Descontos:</p>
              <hr>
              <div class="row">
                <div class="col-md-6 text-left">
                  <p>Outros</p>
                </div>
                <div class="col-md-6 text-left">
                  <p>248,07</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


</body>

</html>