

$(document).ready(function () {

  //todos os "listeners" relacionados a atualização de tabela do menu-principal

  $(document).ready(function (){
    escrevertabela();
  });

  $(document).on("click", ".page-link", function (event) {
    var pagina = $(this).attr("id");
    event.preventDefault();
    escrevertabela(pagina);
    });
});

function escrevertabela(pagina) {

  $.ajax({
    type: "POST",
    url: "./interesseTabela.php",
    data: {
      pagina: pagina,
    },
    success: function (dados) {
      document.getElementById("conteudo-tabela").innerHTML = dados;
    },
    error: function (request, status, erro) {
      alert("Problema ocorrido: " + status + "\nDescrição: " + erro);

      alert("Informações da requisição: \n" + request.getAllResponseHeaders());
    },
  });
  $.ajax({
    type: "POST",
    url: "./paginacao_interesses.php",
    data: {
      pagina: pagina,
    },
    success: function (dados) {
      document.getElementById("paginacao").innerHTML = dados;
    },
    error: function (request, status, erro) {
      alert("Problema ocorrido: " + status + "\nDescrição: " + erro);

      alert("Informações da requisição: \n" + request.getAllResponseHeaders());
    },
  });
}
