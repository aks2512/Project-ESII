

$(document).ready(function () {

    //todos os "listeners" relacionados a atualização de tabela do menu-principal
    $(document).ready(function (){
      escrevertabela();
    });

    //Carrega informação adicional do funcionário
    $(document).on("click", ".view-data", function () {
      var id = this.id;
      $.ajax({
        type: "POST",
        url: "./funcionarioCamaraModal.php",
        data:{id : id},
      }).done(function (dados) {
        document.getElementById("detalhes").innerHTML = dados;
        $("#funcionarioModal").modal("show");
      });
    });

    $(document).on("click", ".page-link", function (event) {
      var pagina = $(this).attr("id");
      event.preventDefault();
      escrevertabela(pagina);
      });
});

function pesquisaAutomatica() {
  $(document).on("click", ".fc_pesquisa_automatica", function () {
    var valor_pesquisa = $(this).attr("value");
    document.getElementById("busca").value = valor_pesquisa;
    escrevertabela();
  });
}

function escrevertabela(pagina) {
  var busca = document.getElementById("busca").value;
  var mostrar = document.getElementById("controlalinhas").value;
  $.ajax({
    type: "POST",
    url: "./funcionarioCamaraTabela.php",
    data: {
      busca: busca,
      mostrar: mostrar,
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
    url: "./paginacao_funcionarioCamara.php",
    data: {
      busca: busca,
      mostrar: mostrar,
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
