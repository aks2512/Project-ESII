$(document).ready(function () {
  $("#formcadastro").submit(function () {
    var dados = $(this).serialize();
    alert(dados);
    $.ajax({
      type: "POST",
      url: "inserirusuario.php",
      data: dados,
      dataType: "json",
      beforeSend: function () {
        document.getElementById("botaoentrar").innerText = "Verificando...";
      },
      success: function (array) {
        var contextp = JSON.parse(array);
        if (contexto.codigo == 1) {
          document.getElementById("okmsg").innerHTML =
            '<div class="alert alert-success">Cadastro feito com sucesso!</div>';
        } else {
          document.getElementById("errmsg").innerHTML =
            '<div class="alert alert-danger">' + contexto.mensagem + "</div>";
        }
      },
      error: function () {
        alert(array);
      },
    });
  });
  $("#formulariologin").submit(function () {
    var dados = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "checarlogin.php",
      data: dados,
      dataType: "json",
      success: function (data) {
        alert("sucesso!");
        if (contexto.codigo == 0) {
          document.getElementById("errmsg").innerHTML =
            '<div class="alert alert-danger">' + contexto.mensagem + "</div>";
        }
      },
    });
  });
});
