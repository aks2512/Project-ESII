<!-- Visualizaçao Principal (Exibição dos Projetos)-->
<div class="col-md-12 text-center " id="funcoes">
    <div class="row justify-content-center">
      <h3 id="title-h3" class="col-md-12">Projetos</h3>
      <p id="p-text" class="col-md-10 text-left">
        Gastos com servidores públicos, dentro dos limites estabelecidos pela Lei de Responsabilidade
        Fiscal, podem ser verificados e acompanhados periodicamente.
      </p>
    </div>

    <!-- Barra Pesquisa -->
    <form id="formulario-pesquisa" method="post">
      <div class="container">

        <div class="row">
          <div class="col-md-3">
            <div class="row justify-content-center align-items-center">
              <p class="p-form col-md-4 m-0">Mostrar</p>
              <select class="col-md-4" id="controlalinhas" name="qtdeLinhas" type="number" title="quantidade de items a aparecer (quanto mais itens, mais lenta a página...)">
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
              <select class="col-md-5" id="ano" name="ano" type="number">
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2011">2012</option>
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
              <input class="col-md-6" id="busca" type="text">
            </div>
          </div>

            <div class="col-md-4 mt-2">
              <div class="row justify-content-center align-items-center">
                <p class="p-form col-md-3 m-0">Projeto</p>
                <select class="col-md-6" id="projeto" name="projeto" type="number">
                  <option value="Lei Ordinaria">Lei Ordinaria</option>
                  <option value="Lei Complementa">Lei Complementar</option>
                  <option value="Lei de Emenda à Lei Orgânica">Lei de Emenda à Lei Orgânica</option>
                  <option value="Lei de Decreto Legislativo">Lei de Decreto Legislativo</option>
                  <option value="Lei de Resolução">Lei de Resolução</option>
                </select>
              </div>
            </div>
        </div>
      </div>
    </form>

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
            </tr>
          </thead>
          <tbody id="conteudo-tabela">
          </tbody>
        </table>
      </div>
    </div>
    
    <!-- nº Registros e Paginação -->
    <div id="paginacao"></div>

    <script src="scriptJS/carregaTabelaProjeto.js"></script>
