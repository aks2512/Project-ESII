<!-- Visualizaçao Principal (Exibição dos Projetos)-->
<div class="col-md-12 text-center " id="funcoes">
    <div class="row justify-content-center">
      <h3 id="title-h3" class="col-md-12">Projetos</h3>
    </div>

    <!-- Barra Pesquisa -->
    <form id="formulario-pesquisa" method="post">
      <div class="container">

        <div class="row">
          <div class="col-md-3">
            <div class="row justify-content-center align-items-center">
              <p class="p-form col-md-4 m-0">Mostrar</p>
              <select class="col-md-4" id="controlalinhas" name="qtdeLinhas" type="number" onchange="escrevertabela();">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="row justify-content-center align-items-center">
              <p class="p-form col-md-3 m-0">Ano</p>
              <select class="col-md-5" id="ano" name="ano" type="number" onchange="escrevertabela();">
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="2009">2009</option>
                <option value="2008">2008</option>
                <option value="2007">2007</option>
                <option value="2006">2006</option>
                <option value="2005">2005</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="row justify-content-center align-items-center">
              <p class="p-form col-md-3 m-0">Buscar</p>
              <input class="col-md-6" id="busca" type="text" onclick="escrevertabela();">
            </div>
          </div>

            <div class="col-md-4 mt-2">
              <div class="row justify-content-center align-items-center">
                <p class="p-form col-md-3 m-0">Projeto</p>
                <select class="col-md-6" id="projeto" name="projeto" type="number" onchange="escrevertabela();">
                  <option value="leiordinaria">Lei Ordinaria</option>
                  <option value="leicomplementar">Lei Complementar</option>
                  <option value="pelo">Emenda a Lei Orgânica</option>
                  <option value="decreto legislativo">Decreto Legislativo</option>
                  <option value="resolução">Resolução</option>
                </select>
              </div>
            </div>
        </div>
      </div>
    </form>

    <div class="row justify-content-start align-left mt-5">
      <div class="col-md-6 text-center">
        <!-- Botões -->
        <button id="btn-inserir" class="btn btn-primary" data-toggle="modal" data-target="#OptIncluir" href="" onclick="inserir()">Inserir</button>
        <button id="btn-excluir" class="btn btn-danger" onclick="excluir()" href="">Excluir</button>
        <button id="btn-historico" class="btn btn-secondary" href="">Histórico</button>
      </div>
    </div>

    <!-- Tabela -->
    <div class="container">
      <div class="row justify-content-center">
        <table class="table striped col-md-10" id="tabela-principal">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Autor</th>
              <th scope="col">Assunto</th>
              <th scope="col">Anotação</th>
              <th scope="col"> </th>
              <th scope="col"> </th>
              <th scope="col"> </th>
            </tr>
          </thead>
          <tbody id="conteudo-tabela">
          </tbody>
        </table>
      </div>
    </div>
    <!-- nº Registros e Paginação -->
    <div id="paginacao"></div>

    <script src="scriptJS/carregaTabelaProjetoAdm.js"></script>
    <script src="scriptJS/projetoCrud.js"></script>

<div class="modal fade" id="OptIncluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="Incluir"> </div>
  </div>
</div>

<div class="modal fade" id="OptAtualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="Atualizar"></div>
  </div>
</div>