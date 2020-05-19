$(document).ready(function () {
  $("#formulariologin").submit(function () {
    var dados = $(this).serialize;
    $.ajax({
      method: "POST",
      data: dados,
      url: "PHP_Action/checarlogin.php",
      dataType: "json",
      success: function (data) {
        document.getElementById("errmsg").innerText = data.mensagem;
      },
      erro: function (data) {
        document.getElementById("errmsg").innerText = data.mensagem;
      },
    });
  });
});
