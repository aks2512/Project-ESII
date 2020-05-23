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
  $("#formcadastro").submit(function () {
    //Carrega dados sobre cadastro do funcionário
    var dados = $(this).serialize();
    $.ajax({
      method: "POST",
      dataType: "json",
      url: "./PHP_Action/inserirfuncionario.php",
      data: dados,
      cache: false,
      success: function (contexto) {
        alert("sucesso!");
        if (contexto.codigo == 1) {
          document.getElementById("okmsg").innerHTML =
            '<div class="alert alert-success">Cadastro feito com sucesso!</div>';
        } else {
          document.getElementById("errmsg").innerHTML =
            '<div class="alert alert-danger">' + contexto.mensagem + "</div>";
        }
      },
      beforeSend: function () {
        document.getElementById("cadastrar").innerText = "Verificando...";
      },
    });
  });
  //Listeners para incrementar quantidade de campos input conforme requisitado
  $("#reqtde").keyup(function () {
    //obs: name="nome[]" indica array, onde elementos que o forman devem ter o mesmo nome
    var i = this.value;
    var inputspace =
      '<td><input id="inputbox"  id="Rtipo" class="col-md-6" name="TR[]" placeholder="TIPO"><input id="inputbox"  id="Rval" class="col-md-6" name="VR[]" placeholder="Valor"></td>'; //Armazena Dupla de input onde deve ser colocado o tipo e valor do item de remuneração ex:salario - 300
    if (i > 20) {
      alert("Não pode haver mais de 20 tipos!");
      i = 20;
    }
    if (i == 0) {
      alert("Nao pode ser igual a 0!");
    }
    while (i > 1) {
      inputspace =
        inputspace +
        '<td><input id="inputbox"  id="Rtipo" class="col-md-6" name="TR[]" placeholder="TIPO"><input id="inputbox"  id="Rval" class="col-md-6" name="VR[]" placeholder="Valor"></td>';
      i--;
    }
    document.getElementById("reinput").innerHTML = inputspace;
  });
  $("#deqtde").keyup(function () {
    var i = this.value;
    var inputspace =
      '<td><input id="inputbox"  id="Dtipo" class="col-md-6" name="TD[]" placeholder="TIPO"><input id="inputbox"  id="Dval" class="col-md-6" name="VD[]" placeholder="Valor"></td>';
    if (i > 20) {
      alert("Não pode haver mais de 20 tipos!");
      i = 20;
    }
    if (i == 0) {
      alert("Nao pode ser igual a 0!");
    }
    while (i > 1) {
      inputspace =
        inputspace +
        '<td><input id="inputbox"  id="Dtipo" class="col-md-6" name="TD[]" placeholder="TIPO"><input id="inputbox"  id="Dval" class="col-md-6" name="VD[]" placeholder="Valor"></td>';
      i--;
    }
    document.getElementById("redescontos").innerHTML = inputspace;
  });
});
