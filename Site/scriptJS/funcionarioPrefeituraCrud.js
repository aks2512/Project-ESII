//Inseri conteudo do modal inserir
function inserir() {
  $(document).on("click", "#btn-inserir", function () {
    $.ajax({
      url: "./funcionarioPrefeituraFormInserir.php",
      success: function (html) {
        document.getElementById("Incluir").innerHTML = html;
      },
    });
  });
}

//Atualizar
function atualizar(){
  $(document).on("click", ".view-data", function () {
    var id = this.id;
    $.ajax({
      type: "POST",
      url: "./funcionarioPrefeituraFormAtualizar.php",
      data:{id : id},
    }).done(function (dados) {
      document.getElementById("Atualizar").innerHTML = dados;
      $("#OptAtualizar").modal("show");
    });
  });
}


//Exclui os funcionarios selecionados
function excluir() {
  var funcionarios = document.querySelectorAll("[name=funcionario_prefeitura]:checked"); //apanhar todos
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
        url: "./funcionarioPrefeituraExcluir.php",
        data: { id: id },
        success: function (retorno) {
          escrevertabela();
        },
        done: function () {
          alert("Pronto");
        },
      });
    }
  }
}


