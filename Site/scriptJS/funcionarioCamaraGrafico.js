function pegarDados() {
    var funcionarios = document.querySelectorAll("[name=funcionario_camara]:checked"); //apanhar todos
    var id = [];

    if (funcionarios.length < 2 || funcionarios.length > 4) {
        alert("Selecione 2 a 4 funcionários");
        return false;
    } else {
        for (var i = 0; i < funcionarios.length; i++) {
            id.push(funcionarios[i].value);
        }
        $.ajax({
            type: "POST",
            url: "./funcionarioCamaraGrafico.php",
            data: { id: id },
            success: function (dados) {
                document.getElementById("scriptGrafico").innerHTML="";
                $('#scriptGrafico').append(dados);
            },
        }).done(function (dados) {
            $("#OptGrafico").modal("show");
          });
    }
}
