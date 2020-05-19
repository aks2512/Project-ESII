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
  $(document).on("click", "#maisinfo", function () {
    var onde = this.value;
    $.ajax({
      type: "POST",
      url: "../PHP_Action/processarmaisinfo.php",
      data: {
        busca: onde,
      },
      success: function (dados) {},
    });
  });
});

function escrevertabela() {
  var busca = document.getElementById("busca").value;
  $.ajax({
    type: "POST",
    url: "../PHP_Action/processartabela.php",
    data: {
      busca: busca,
    },
    success: function (dados) {
      document.getElementById("conteudo-tabela").innerHTML = dados;
    },
  });
}
