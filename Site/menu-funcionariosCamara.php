<!-- Visualizaçao Principal (Exibição dos Servidores Públicos)-->
    <div class="row justify-content-center">
      <h3 id="title-h3">Funcionários Câmara</h3>
    </div>
    <div class="my-5">
      <div class="row align-items-center justify-content-center">
        <button class="col-md-3 fc_pesquisa_automatica btn btn-outline-primary" value="prefeito" onclick="pesquisaAutomatica();">Pesquisar Vereador</button>
        <button class="col-md-3 fc_pesquisa_automatica btn btn-outline-success" value="30000" onclick="pesquisaAutomatica();">Pesquisar Salário de 30000</button>
        <button class="col-md-3 fc_pesquisa_automatica btn btn-outline-danger" value="5000" onclick="pesquisaAutomatica();">Pesquisa Salário de 5000</button>
      </div>
    </div>

    <!-- Barra Pesquisa -->
    <form id="formulario-pesquisa" method="post" class="col-md-10">
      <div class="row">
        <div class="col-md-4">
          <div class="row justify-content-center align-items-center">
            <p class="p-form col-md-4 m-0">Mostrar</p>
            <select class="col-md-4" id="controlalinhas" name="qtdeLinhas" type="number"
              title="quantidade de items a aparecer (quanto mais itens, mais lenta a página...)" onchange="escrevertabela();">
              <option value=10>10</option>
              <option value=25>25</option>
              <option value=50>50</option>
              <option value=100>100</option>
            </select>
          </div>
        </div>
        <div class="col-md-8">
          <div class="row justify-content-center align-items-center">
            <p class="p-form m-0 col-md-2">Buscar</p>
            <input class="col-md-9" id="busca" type="text" onkeyup="escrevertabela();">
          </div>
        </div>

      </div>
    </form>

    <!-- Mostrar Gráfico e Paginas-->
    <div class="row justify-content-center mt-5">
      <div class="col-md-10 text-left">
        <!-- Mostrar Gráfico -->
        <a id="btn-grafico" class="btn btn-default" href="">Gráfico</a>
      </div><!-- Navegação Páginas da Tabela -->
    </div>

    <div class="container">
      <div class="row justify-content-center">
        <table class="table striped col-md-12" id="tabela-principal">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">#</th>
              <th scope="col">Funcionário</th>
              <th scope="col">Cargo</th>
              <th scope="col">Remuneração</th>
              <th scope="col">*</th>
              <th scope="col"> </th>
              <th scope="col"> </th>
            </tr>
          </thead>
          <tbody id="conteudo-tabela"></tbody>
        </table>
      </div>
    </div>
    
    <hr>

    <div id="paginacao"></div>

    <script src="scriptJS/carregaTabelaFuncionarioCamara.js"></script>

<div class="modal fade" id="funcionarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" id="detalhes">


      </div>
    </div>
  </div>

  