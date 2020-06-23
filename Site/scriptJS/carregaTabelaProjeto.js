

$(document).ready(function () {

    //todos os "listeners" relacionados a atualização de tabela do menu-principal
    $("#busca").keyup(function () {
      escrevertabela();
    });

    $("#controlalinhas").change(function () {
      escrevertabela();
    });

    $("#projeto").change(function () {
      escrevertabela();
    });

    $("#ano").change(function () {
      escrevertabela();
    });

    $(document).ready(function (){
      escrevertabela();
    });

    $(document).on("click", ".page-link", function (event) {
      var pagina = $(this).attr("id");
      event.preventDefault();
      escrevertabela(pagina);
      });
});

  function escrevertabela(pagina) {
    var busca = document.getElementById("busca").value;
    var mostrar = document.getElementById("controlalinhas").value;
    var projeto = document.getElementById("projeto").value;
    var ano = document.getElementById("ano").value;
    $.ajax({
      type: "POST",
      url: "./projetoTabela.php",
      data: {
        busca: busca,
        mostrar: mostrar,
        pagina: pagina,
        projeto: projeto,
        ano: ano,
      },
      success: function (dados) {
        document.getElementById("conteudo-tabela").innerHTML = dados;
      },
      error: function (request, status, erro) {
        alert("Problema ocorrido: " + status + "\nDescrição: " + erro);
  
        alert("Informações da requisição: \n" + request.getAllResponseHeaders());
      },
    });
    $.ajax({
      type: "POST",
      url: "./paginacao_projeto.php",
      data: {
        busca: busca,
        mostrar: mostrar,
        pagina: pagina,
        projeto: projeto,
        ano: ano,
      },
      success: function (dados) {
        document.getElementById("paginacao").innerHTML = dados;
      },
      error: function (request, status, erro) {
        alert("Problema ocorrido: " + status + "\nDescrição: " + erro);
  
        alert("Informações da requisição: \n" + request.getAllResponseHeaders());
      },
    });
  }
  