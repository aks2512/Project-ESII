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

  $(document).on("click", "#btn-inserir", function () {
    //Escreve conteudo do modal incluir
    $.ajax({
      url: "./Replacer/BD.php",
      success: function (html) {
        document.getElementById("incluir").innerHTML = html;
      },
    });
  });
});

function escrevertabela() {
  var busca = document.getElementById("busca").value;
  var tabela = 1;
  $.ajax({
    type: "POST",
    url: "./PHP_Action/processartabela.php",
    data: {
      busca: busca,
      tabela: tabela,
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

$(document).ready(function () {
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
function atualizar() {}

function excluir() {
  var funcionarios = document.querySelectorAll("[name=funcionario]:checked"); //apanhar todos
  var id = [];

  if (funcionarios.length == 0) {
    alert("Selecione um ou mais funcionários para deletar");
    return false;
  } else {
    if (
      !confirm(
        "Tem certeza que deseja excluir os dados dos funcionarios selecionados?"
      )
    ) {
      return false;
    } else {
      for (var i = 0; i < funcionarios.length; i++) {
        // utilize o valor aqui, adicionei ao array para exemplo
        id.push(funcionarios[i].value);
      }
      $.ajax({
        type: "POST",
        url: "./PHP_Action/callmethod.php",
        data: { id: id },
        success: function (retorno) {
          alert(retorno);
          escrevertabela();
        },
        done: function () {
          alert("Pronto");
        },
      });
    }
  }
}
