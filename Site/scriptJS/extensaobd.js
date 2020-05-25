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
    //Listeners para incrementar quantidade de campos input conforme requisitado
  });
  $(document).on("keyup", "#reqtde", function () {
    var i = this.value;
    var inputspace =
      '<td><input id="inputbox"  id="Rtipo" class="col-md-6" name="TR[]" placeholder="TIPO"><input id="inputbox"  id="Rval" class="col-md-6" name="VR[]" placeholder="Valor"></td>'; //
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
  $(document).on("keyup", "#deqtde", function () {
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
