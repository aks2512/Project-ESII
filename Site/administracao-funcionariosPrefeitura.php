<!-- Visualizaçao Principal (Exibição dos Servidores Públicos)-->
<div class="row justify-content-center">
  <h3 id="title-h3">Funcionário Prefeitura</h3>
</div>

<!-- Barra Pesquisa -->
<form id="formulario-pesquisa" method="post" class="col-md-10">
  <div class="row">
    <div class="col-md-4">
      <div class="row justify-content-center align-items-center">
        <p class="p-form col-md-4 m-0">Mostrar</p>
        <select class="col-md-4" id="controlalinhas" name="qtdeLinhas" type="number"
          title="quantidade de items a aparecer (quanto mais itens, mais lenta a página...)">
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
        <input class="col-md-9" id="busca" type="text">
      </div>
    </div>

  </div>
</form>

<!-- Mostrar Gráfico e Paginas-->
<div class="row justify-content-center mt-5">
  <div class="col-md-10 text-left">
    <!-- Botões -->
    <button id="btn-inserir" class="btn btn-primary" onclick="inserir()" data-toggle="modal" data-target="#OptIncluir" href="">Inserir</button>
    <button id="btn-excluir" class="btn btn-danger" onclick="excluir()" href="">Excluir</button>
    <button id="btn-grafico" class="btn btn-success" onclick="" href="">Gráfico</button>
    <button id="btn-historico" class="btn btn-secondary" href="">Histórico</button>
  </div>
</div>

<!-- Tabela -->
<div class="container">
  <div class="row justify-content-center">
    <table class="table striped col-md-10" id="tabela-principal">
      <thead>
        <tr>
          <th scope="col">Add</th>
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
 
<hr>

<div id="paginacao">

</div>

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

<script src="scriptJS/carregaTabelaFuncionarioPrefeituraAdm.js"></script>
<script src="scriptJS/addInputFuncionarioPrefeitura.js"></script>
<script src="scriptJS/funcionarioPrefeituraCrud.js"></script>