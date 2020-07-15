<!-- Visualizaçao Principal (Exibição dos Servidores Públicos)-->
    <div class="row justify-content-center">
      <h3 id="title-h3">Funcionários Prefeitura</h3>
    </div>
    <div class="my-5">
      <div class="row align-items-center justify-content-center">
        <button class="col-md-3 fp_pesquisa_automatica btn btn-outline-primary" name="cargo" value="AGENTE ESCOLAR" onclick="pesquisaAutomatica();">Pesquisar Agente Escolar</button>
        <button class="col-md-3 fp_pesquisa_automatica btn btn-outline-success" name="cargo" value="ENFERMEIRO" onclick="pesquisaAutomatica();">Pesquisar Enfermeiro</button>
        <button class="col-md-3 fp_pesquisa_automatica btn btn-outline-danger" name="tbruto" value="5012.06" onclick="pesquisaAutomatica();">Pesquisa Salário de até 5012.06</button>
      </div>
    </div>

    <!-- Barra Pesquisa -->
    <form id="formulario-pesquisa" method="post" class="col-md-10">
      <div class="row justify-content-center align-items-center">

        <div class="col-md-4">
          <label>Mostrar
            <select id="controlalinhas" name="qtdeLinhas" type="number" onchange="escrevertabela();">
              <option value=10>10</option>
              <option value=25>25</option>
              <option value=50>50</option>
              <option value=100>100</option>
            </select>
          </label>
        </div>

        <div class="col-md-4">
          <label>Filtro
            <select id="filtro" name="filtro" type="number" onchange="registrarPesquisa();">
              <option value=nome>Nome</option>
              <option value=cargo>Cargo</option>
              <option value=tbruto>Salário</option>
            </select>
          </label>
        </div>

        <div class="col-md-4">
          <label>Buscar
            <input class="col-md-9" id="busca" type="text" onkeyup="escrevertabela();">
          </label>
        </div>
      </div>
    </form>

    <!-- Mostrar Gráfico e Paginas-->
    <div class="row justify-content-center mt-5">
      <div class="col-md-10 text-left">
        <!-- Mostrar Gráfico -->
        <button id="btn-grafico" class=" btn " onclick="pegarDados()">Gráfico</button>
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

<div class="modal fade" id="funcionarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" id="detalhes">


      </div>
    </div>
  </div>

  <div class="modal" id="OptGrafico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
  <div class="modal-content modal-xl container" role="document">
    <div id="Grafico" style="width: 100%; height: 500px;"></div>
  </div>
</div>
  
<div id="scriptGrafico">
  <?php require('./funcionarioPrefeituraGrafico.php');?>
</div>
<script src="scriptJS/carregaTabelaFuncionarioPrefeitura.js"></script>
<script src="scriptJS/funcionarioPrefeituraGrafico.js"></script>

