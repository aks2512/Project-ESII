$(document).ready(function () {
  $("input").keyup(function () {
    document.getElementById("botaoentrar").innerText = "Entrar";
    document.getElementById("errmsg").style.display = "none";
  });
  $("#formulariologin").on("submit", function (e) {
    var dados = $(this).serialize;
    $.ajax({
      method: "POST",
      data: dados,
      url: "./PHP_Action/checarlogin.php",
      dataType: "json",
      success: function (data) {
        alert(data.codigo);
        if (data.codigo == 1) {
          e.preventDefault();
          document.getElementById("errmsg").style.display = "inline-block";
          document.getElementById("botaoentrar").innerText = "Entrar";
          document.getElementById("errmsg").innerText = data.mensagem;
        } else {
          $(this).submit();
        }
      },
      beforeSend: function () {
        document.getElementById("botaoentrar").innerText = "Entrando...";
      },
    });
  });
  $("#botaoentrar").click(function () {
    document.getElementById("botaoentrar").style.backgroundColor = "green";
    document.getElementById("botaoentrar").innerText = "Entrando...";
  });
});
