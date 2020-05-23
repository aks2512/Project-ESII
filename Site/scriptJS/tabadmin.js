$(document).ready(function () {
  $(document).on("click", ".view-data", function () {
    var id = $(this).attr("id");
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
