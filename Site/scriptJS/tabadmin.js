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
  $(document).on("click", "#continuar", function () {
    var j = document.getElementById("continuar").value;
    j = parseInt(j) || 0;
    atualizar(j + 1);
  });
  $(document).on("click", "#rmDetalhe", function () {
    var id = this.value;
    document.getElementById(id).innerHTML =
      '<div class="col-md-9 deletado" value="' + id + '">Deletado...</div>';
  });
  $(document).on("click", "#confirmar", function () {
    if (confirm("Deseja confirmar as alterações?")) {
      $.each($(".deletado"), function () {
        var id = $(this).attr("value");
        id = parseInt(id);
        alert(typeof id);
        $.ajax({
          type: "POST",
          url: "./PHP_Action/deletar_item.php",
          data: { id: id },
        });
      });
    }
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
    var id = this.value;
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

function selecionados() {
  var funcionarios = document.querySelectorAll("[name=funcionario]:checked"); //apanhar todos
  return funcionarios;
}

function atualizar(i) {
  var funcionarios = selecionados();
  if (funcionarios.length == 0) {
    alert("Selecione um ou mais funcionários para atualizar");
    return false;
  } else {
    id = funcionarios[i].value;
    pos = i;
    $.ajax({
      type: "POST",
      url: "./PHP_Action/carregaratualizar.php",
      data: { id: id, pos: pos },
      success: function (retorno) {
        document.getElementById("Atualizar").innerHTML = retorno;
        $("#OptAtualizar").modal("show");
      },
      done: function () {
        alert("Pronto");
      },
    });
  }
}

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
