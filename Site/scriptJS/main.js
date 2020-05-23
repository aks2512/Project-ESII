$(document).ready(function () {
  //todos os "listeners" relacionados a atualização de tabela do menu-principal
  $("#busca").keyup(function () {
    escrevertabela();
  });
  $("#qtdeLinhas").change(function () {
    escrevertabela();
  });
  $(document).ready(function () {
    escrevertabela();
  });

  //Carrega informação adicional do funcionário
  $(document).on("click", ".view-data", function () {
    var id = $(this).attr("id");
    var dados = { id: id };
    $.ajax({
      type: "POST",
      url: "./PHP_Action/carregarmodal.php",
      data: dados,
    }).done(function (dados) {
      document.getElementById("detalhes").innerHTML = dados;
      $("#exampleModal").modal("show");
    });
  });
});

function escrevertabela() {
  var busca = document.getElementById("busca").value;
  $.ajax({
    type: "POST",
    url: "./PHP_Action/processartabela.php",
    data: {
      busca: busca,
    },
    success: function (dados) {
      document.getElementById("conteudo-tabela").innerHTML = dados;
    },
    error: function (request, status, erro) {
      alert("Problema ocorrido: " + status + "\nDescrição: " + erro);

      alert("Informações da requisição: \n" + request.getAllResponseHeaders());
    },
  });
}
