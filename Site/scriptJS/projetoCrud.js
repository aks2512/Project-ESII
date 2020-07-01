//Inseri conteudo do modal inserir
function inserir() {
  $(document).on("click", "#btn-inserir", function () {
    $.ajax({
      url: "./projetoFormInserir.php",
      success: function (html) {
        document.getElementById("Incluir").innerHTML = html;
        $("#OptIncluir").modal("show");
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
      url: "./projetoFormAtualizar.php",
      data:{id : id},
    }).done(function (dados) {
      document.getElementById("Atualizar").innerHTML = dados;
      $("#OptAtualizar").modal("show");
    });
  });
}


//Exclui os funcionarios selecionados
function excluir() {
  var projetos = document.querySelectorAll("[name=projeto]:checked"); //apanhar todos
  var id = [];

  if (projetos.length == 0) {
    alert("Selecione um ou mais projetos para deletar");
    return false;
  } else {
    if (
      !confirm(
        "Tem certeza que deseja excluir os dados dos projetos selecionados?"
      )
    ) {
      return false;
    } else {
      for (var i = 0; i < projetos.length; i++) {
        id.push(projetos[i].value);
      }
      $.ajax({
        type: "POST",
        url: "./projetoExcluir.php",
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


