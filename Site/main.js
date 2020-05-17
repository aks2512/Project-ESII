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
      url: "PHP_Action/processarmaisinfo.php",
      data: {
        busca: onde,
      },
      success: function (dados) {
        $("#funcoes").html(dados);
      },
    });
  });

  $("#retornar").click(function () {});

  //Carrega conteúdo adicional relacionado a opção do menu lateral
  $(".menu-opcao").click(function () {
    var carrega_url = this.id;
    carrega_url = carrega_url + "_conteudo.html";
    $.ajax({
      url: carrega_url,
      success: function (data) {
        $("#funcoes").innerHTML = data;
      },
    });
  });
});

function escrevertabela() {
  var busca = document.getElementById("busca").value;
  $.ajax({
    type: "POST",
    url: "PHP_Action/processartabela.php",
    data: {
      busca: busca,
    },
    success: function (dados) {
      document.getElementById("conteudo-tabela").innerHTML = dados;
    },
  });
}
