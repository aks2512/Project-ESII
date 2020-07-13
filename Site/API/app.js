const express = require("express");
const app = express();
var reqq = 0;
var webcrawler = false;
app.get("/API", function(req, res) {
    res.send("MAIN")
})

app.get("/API/ligar_webcrawler", function(req, res) {
    if (webcrawler == false) {
        var funcionarios = require("../../webcrawler/spider");
        webcrawler = true;
        funcionarios.todos_os_funcionarios(true, true) //com contagem automatica + funcionarios camara +prefeitura
        res.send("...Webcrawler Inicializado...")
    } else {
        console.log("Webcrawler já está ligado");
    }
    return;
})

app.get("/API/carregar_funcionarios_geral", function(req, res) {
    if (reqq == 0) {
        reqq = 1
        var funcionarios = require("../../webcrawler/spider");
        funcionarios.todos_os_funcionarios(false, true) //funcionarios camara + prefeitura
        res.json({
            aviso: "ok!"
        });
    } else {
        console.log("Aguarde a operação anterior...")
    }
    return;
})

app.get("/API/carregar_funcionarios_prefeitura", async function(req, res) {
    if (reqq == 0) {
        reqq = 1
        var funcionarios = require("../../webcrawler/spider")
        funcionarios.todos_os_funcionarios(false, false);
        res.send("Carregando...");
    } else {
        console.log("Aguarde a operação anterior...")
    }
    return;

})

app.get("/API/carregar_funcionarios_camara", async function(req, res) {
    if (reqq == 0) {
        reqq = 1
        var funcionarios = require("../../webcrawler/prepara_pdf");
        funcionarios.pegar_cargos();
    } else {
        console.log("Aguarde a operação anterior...")
    }
    return;
})

app.get("/API/carregar_projetos", function(req, res) {
    if (reqq == 0) {
        reqq = 1
        var projetos = require("../../webcrawler/projetos")
        projetos.principal(false);
    } else {
        console.log("Aguarde a operação anterior...")
    }
    return;
})

app.get("/API/selecionar_funcionarios_prefeitura", function(req, res) {
    var select = require("../../webcrawler/retorna_json");

    var resultado = select.func_prefeitura(function(resultado) {
        res.json(resultado);

        console.log("retornado com sucesso!");

        return resultado;
    });
    return;
})

app.get("/API/selecionar_funcionarios_camara", function(req, res) {
    var select = require("../../webcrawler/retorna_json");
    var resultado = select.func_camara(function(resultado) {
        res.json(resultado);
        console.log("retornado com sucesso!");
        return resultado;
    });
    return;
})

app.get("/API/selecionar_projetos", function(req, res) {
    var select = require("../../webcrawler/retorna_json");
    var resultado = select.projetos(function(resultado) {
        res.json(resultado);
        console.log("retornado com sucesso!");
        return resultado;
    });
    return;
})

app.get("/")

var port = process.env.PORT || 3000;
app.listen(port, function() {
    console.log("Escutando porta " + port);
})

module.exports = app;