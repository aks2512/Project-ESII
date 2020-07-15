<!-- Visualizaçao Principal (Exibição dos Projetos)-->
<div class="col-md-12 text-center " id="funcoes">
    <div class="row justify-content-center">
      <h3 id="title-h3" class="col-md-12">Projetos</h3>
    </div>
    <div class="my-5">
      <div class="row align-items-center justify-content-center">
        <button class="col-md-3 p_pesquisa_automatica btn btn-outline-primary" value="prefeito" onclick="pesquisaAutomatica();">Pesquisar Projetos do Prefeito</button>
        <button class="col-md-3 p_pesquisa_automatica btn btn-outline-success" value="Aprovado" onclick="pesquisaAutomatica();">Pesquisar Projetos Aprovados</button>
      </div>
    </div>

    <!-- Barra Pesquisa -->
    <form id="formulario-pesquisa" method="post">
      <div class="container">
        <div class="row justify-content-center align-items-center">

          <div class="col-md-2">
              <label>Mostrar
                <select id="controlalinhas" name="qtdeLinhas" type="number" onchange="escrevertabela();">
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                </select>
              </label>
          </div>

          <div class="col-md-3">
              <label>Ano
                <select id="ano" name="ano" type="number" onchange="escrevertabela();">
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
              </label>
          </div>

          <div class="col-md-3">
            <label>Buscar
              <input id="busca" type="text" onclick="registrarPesquisa();" onkeyup="escrevertabela();">
            </label>
          </div>

          <div class="col-md-3">
            <label>Projeto
              <select id="projeto" name="projeto" type="number" onchange="escrevertabela();">
                <option value="leiordinaria">Lei Ordinaria</option>
                <option value="leicomplementar">Lei Complementar</option>
                <option value="pelo">Emenda a Lei Orgânica</option>
                <option value="decreto legislativo">Decreto Legislativo</option>
                <option value="resolução">Resolução</option>
              </select>
            </label>
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
    
  
