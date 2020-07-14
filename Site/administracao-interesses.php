<!-- Visualizaçao Principal (Exibição dos Servidores Públicos)-->
<div class="row justify-content-center">
  <h3 id="title-h3">Pesquisa de Interesses</h3>
</div>

<!-- Barra Pesquisa -->
<form id="formulario-pesquisa" method="post" class="col-md-10">
  <div class="row">
    <div class="col-md-12">
      <div class="row justify-content-center align-items-center">
        <p class="p-form m-0 col-md-2">Buscar</p>
        <input class="col-md-9" id="busca" type="text">
      </div>
    </div>

  </div>
</form>

<!--Paginas-->
<div class="row justify-content-end mt-5">
  <!-- Navegação Páginas da Tabela -->
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
          <th scope="col">Add</th>
          <th scope="col">#</th>
          <th scope="col">Data</th>
          <th scope="col">IP</th>
          <th scope="col">Filtro</th>
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



