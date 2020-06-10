$(document).ready(function () {
  //todos os "listeners" relacionados a atualização de tabela do menu-principal
  $("#busca").keyup(function () {
    escrevertabela();
  });
  $("#controlalinhas").change(function () {
    escrevertabela();
  });
  $(document).ready(function () {
    escrevertabela();
  });
  //carrega Modal funcionarios
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
    var valorant = document.getElementById(id).innerHTML;
    if (valorant > 0) {
      document.getElementById(id).innerHTML = "";
      document.getElementById(id).innerHTML =
        '<div class="col-md-9 deletado deletado' +
        id +
        '" value="' +
        id +
        '" id="' +
        valorant +
        '">Deletado...</div>';
    } else {
      var valorant = $(".deletado" + id).attr("id");
      if (valorant === undefined) {
        var valorant = $(".editado" + id).attr("id");
        document.getElementById(id).innerHTML =
          '<div class="col-md-9 deletado deletado' +
          id +
          '" value="' +
          id +
          '" id="' +
          valorant +
          '">Deletado...</div>';
      } else {
        document.getElementById(id).innerHTML = valorant;
      }
    }
  });

  $(document).on("click", "#editDetalhe", function () {
    var id = this.value;
    var valorant = document.getElementById(id).innerHTML;
    if (valorant > 0) {
      document.getElementById(id).innerHTML =
        '<div class="col-md-9 editado editado' +
        id +
        '" id="' +
        valorant +
        '" value="' +
        id +
        '"><input id="Dval' +
        id +
        '" class="col-md-6" name="Valordetalhe[]" placeholder="' +
        valorant +
        '"></div>';
    } else {
      var valorant = $(".editado" + id).attr("id");
      if (valorant === undefined) {
        var valorant = $(".deletado" + id).attr("id");
        document.getElementById(id).innerHTML =
          '<div class="col-md-9 editado editado' +
          id +
          '" id="' +
          valorant +
          '" value="' +
          id +
          '"><input id="Dval' +
          id +
          '" class="col-md-6" name="Valordetalhe[]" placeholder="' +
          valorant +
          '"></div>';
      } else {
        document.getElementById(id).innerHTML = valorant;
      }
    }
  });

  $(document).on("click", "#editCargo", function () {
    var campo = this.value;
    var valorant = document.getElementById(campo).innerText;

    if ($(".editado" + campo).attr("value") != undefined) {
      valorant = $(".editado" + campo).attr("id");
      document.getElementById(campo).innerHTML = valorant;
    } else {
      document.getElementById(campo).innerHTML =
        '<div class="col-md-9 editado editado' +
        campo +
        '" id="' +
        valorant +
        '" value="' +
        campo +
        '"><input id="Dval' +
        campo +
        '" class="col-md-6" placeholder="Cargo"></div>';
    }
  });

  $(document).on("click", "#confirmar", function () {
    if (confirm("Deseja confirmar as alterações?")) {
      $.each($(".editado"), function () {
        var id = $(this).attr("value");
        var valor = document.getElementById("Dval" + id).value;
        var id_funcionario = $("#identificador-principal").attr("value");
        alert(valor);
        if (valor >= 0) {
          $.ajax({
            method: "POST",
            data: { valor: valor, id: id },
            url: "./PHP_Action/Atualizar_Item.php",
          });
        } else {
          $.ajax({
            method: "POST",
            data: { valor: valor, id_funcionario: id_funcionario },
            url: "./PHP_Action/Atualizar_Principal.php",
          });
        }
      });
      $.each($(".deletado"), function () {
        id = $(this).attr("value");
        alert(id);
        $.ajax({
          method: "POST",
          data: { id: id },
          url: "./PHP_Action/deletar_item.php",
        });
      });
    }
  });
});

function escrevertabela() {
  var busca = document.getElementById("busca").value;
  var qtde = document.getElementById("controlalinhas").value;
  var tabela = 1;
  $.ajax({
    type: "POST",
    url: "./PHP_Action/processartabela.php",
    data: {
      qtde: qtde,
      busca: busca,
      tabela: tabela,
    },
    success: function (dados) {
      document.getElementById("conteudo-tabela").innerHTML = dados;
    },
  });
}

function selecionados() {
  var funcionarios = document.querySelectorAll("[name=funcionario]:checked"); //apanhar todos
  return funcionarios;
}

function atualizar(i) {
  var funcionarios = selecionados();
  if (funcionarios.length == 0) {
    alert("Selecione um ou mais funcionários para editar");
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

function addItemDescontos() {
  var qtde = parseInt(document.getElementById("descontosadd").value) || 0;
  document.getElementById("descontosadd").value = qtde + 1;
  var resposta = "";
  for (var i = 0; i <= qtde; i++) {
    var resposta =
      resposta +
      '<div class="row"><input id="inputbox"  id="Dtipo" class="col-md-6" name="TD[]" placeholder="TIPO"><input id="inputbox"  id="Dval" class="col-md-6" name="VD[]" placeholder="Valor"></div>';
  }
  document.getElementById("items-descontos").innerHTML = resposta;
}
function addItemRemuneracao() {
  var qtde = parseInt(document.getElementById("remuneracaoadd").value) || 0;
  document.getElementById("remuneracaoadd").value = qtde + 1;
  var resposta = "";
  for (var i = 0; i <= qtde; i++) {
    resposta =
      resposta +
      '<div class="row"><input id="inputbox"  id="Rtipo" class="col-md-6" name="TR[]" placeholder="TIPO"><input id="inputbox"  id="Rval" class="col-md-6" name="VR[]" placeholder="Valor"></div>';
  }
  document.getElementById("additems-remuneracao").innerHTML = resposta;
}

function rmItemRemuneracao() {
  var qtde = parseInt(document.getElementById("remuneracaoadd").value) || 0;
  if (qtde < 0) {
    document.getElementById("additems-remuneracao").innerHTML = "";
    return;
  }
  document.getElementById("remuneracaoadd").value = qtde - 1;
  var resposta = "";
  for (var i = 0; i < qtde - 1; i++) {
    resposta =
      resposta +
      '<div class="row"><input id="inputbox"  id="Rtipo" class="col-md-6" name="TR[]" placeholder="TIPO"><input id="inputbox"  id="Rval" class="col-md-6" name="VR[]" placeholder="Valor"></div>';
  }
  document.getElementById("additems-remuneracao").innerHTML = resposta;
}
function rmItemDescontos() {
  var qtde = parseInt(document.getElementById("descontosadd").value) || 0;
  if (qtde < 0) {
    document.getElementById("items-descontos").innerHTML = "";
    return;
  }
  document.getElementById("descontosadd").value = qtde - 1;
  var resposta = "";
  for (var i = 0; i < qtde - 1; i++) {
    var resposta =
      resposta +
      '<div class="row"><input id="inputbox"  id="Dtipo" class="col-md-6" name="TD[]" placeholder="TIPO"><input id="inputbox"  id="Dval" class="col-md-6" name="VD[]" placeholder="Valor"></div>';
  }
  document.getElementById("items-descontos").innerHTML = resposta;
}
