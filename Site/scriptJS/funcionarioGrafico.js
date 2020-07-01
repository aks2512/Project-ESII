function pegarDados() {
    var funcionarios = document.querySelectorAll("[name=funcionario]:checked"); //apanhar todos
    var id = [];

    if (funcionarios.length < 2) {
        alert("Selecione dois ou mais funcionários");
        return false;
    } else {
        for (var i = 0; i < funcionarios.length; i++) {
            id.push(funcionarios[i].value);
        }
        $.ajax({
            type: "POST",
            url: "./funcionarioPrefeituraGrafico.php",
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