$(document).ready(function () {
  $("#formulariologin").submit(function () {
    var dados = $(this).serialize;
    $.ajax({
      method: "POST",
      data: dados,
      url: "PHP_Action/checarlogin.php",
      dataType: "json",
      async: true,
      success: function (data) {
        console.log("sucesso! " + data);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        alert(textStatus, errorThrown);
        alert(jqXHR, textStatus, errorThrown);
      },
    });
  });
});
