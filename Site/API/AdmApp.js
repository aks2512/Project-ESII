const express = require("express");
const app = express();
var reqq = 0;

app.use(function(req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});

app.get("/API", function(req, res) {
    res.send("MAIN");
});

app.get("/API/carregar_funcionarios_geral", function(req, res) {
    if (reqq == 0) {
        reqq = 1;
        var funcionarios = require("../../webcrawler/spider");

        funcionarios.todos_os_funcionarios(false, true, function(resultado) {
            console.log("Finalizado com sucesso!");
            res.send("Carregar Funcionarios -> Finalizado com sucesso!");
            reqq = 0;
        }); //funcionarios camara + prefeitura
        res.send("Carregando...");
    } else {
        res.send("Aguarde a operação anterior...");
    }
    return "Resposta";
});

app.get("/API/carregar_funcionarios_prefeitura", async function(req, res) {
    if (reqq == 0) {
        reqq = 1;
        var funcionarios = require("../../webcrawler/spider");
        funcionarios.todos_os_funcionarios(false, false, function(resultado) {
            console.log("Finalizado com sucesso!");
            res.send("Carregar Funcionarios -> Finalizado com sucesso!");
            reqq = 0;
        });
        res.send("Carregando...");
    } else {
        console.log("Aguarde a operação anterior...");
    }
    return;
});

app.get("/API/carregar_funcionarios_camara", async function(req, res) {
    if (reqq == 0) {
        reqq = 1;
        var funcionarios = require("../../webcrawler/prepara_pdf");
        funcionarios.pegar_cargos(function(resultado) {
            console.log("Finalizado com sucesso!");
            reqq = 0;
        });
    } else {
        console.log("Aguarde a operação anterior...");
    }
    return;
});

app.get("/API/carregar_projetos", function(req, res) {
    if (reqq == 0) {
        reqq = 1;
        var projetos = require("../../webcrawler/projetos");
        var resposta = projetos.principal(false, function(resultado) {
            console.log("Finalizado com sucesso!");
            reqq = 0;
            res.send("Finalizado com sucesso!");
        });
    } else {
        console.log("Aguarde a operação anterior...");
        res.send("Aguarde a operação anterior...");
    }
});

app.get("/API/selecionar_funcionarios_prefeitura", function(req, res) {
    var select = require("../../webcrawler/retorna_json");

    var resultado = select.func_prefeitura(function(resultado) {
        res.json(resultado);

        console.log("retornado com sucesso!");

        return resultado;
    });
    return;
});

app.get("/API/selecionar_funcionarios_camara", function(req, res) {
    var select = require("../../webcrawler/retorna_json");
    var resultado = select.func_camara(function(resultado) {
        res.json(resultado);
        console.log("retornado com sucesso!");
        return resultado;
    });
    return;
});

app.get("/API/selecionar_projetos", function(req, res) {
    var select = require("../../webcrawler/retorna_json");
    var resultado = select.projetos(function(resultado) {
        res.json(resultado);
        console.log("retornado com sucesso!");
        return resultado;
    });
    return;
});

app.get("/");

var port = process.env.PORT || 3000;
app.listen(port, function() {
    console.log("Escutando porta " + port);
});

module.exports = app;