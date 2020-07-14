const express = require("express");
const app = express();
var reqq = 0;

var time = new Object();
time.segundos = 0;
time.minutos = 0;
time.horas = 0;
time.dias = 0;

var cont;

function contador() {
    cont = setInterval(function() {
        time.segundos++;
        if (time.segundos == 60) {
            time.segundos = 0;
            time.minutos++;
        }
        if (time.minutos == 60) {
            time.minutos = 0;
            time.horas++;
        }
        if (time.horas == 24) {
            time.horas = 0;
            time.dias++;
        }
    }, 1000)
}


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
        res.send("Acionamento manual executado com sucesso!");
        contador();
        funcionarios.todos_os_funcionarios(false, true, function(resultado) {
            console.log("Finalizado com sucesso!");
            res.send("Carregar Funcionarios -> Finalizado com sucesso!");
            clearInterval(cont);
            reqq = 0;
        }); //funcionarios camara + prefeitura
    } else {
        console.log("Aguarde a operação anterior...,\ntempo de execução atual -> " + time.dias + " Dias/" + time.horas + "h " + time.minutos + "min " + time.segundos + "s ");
        res.send("Aguarde a operação anterior...,\ntempo de execução atual -> " + time.dias + " Dias/" + time.horas + "h " + time.minutos + "min " + time.segundos + "s ");
    }
    return "Resposta";
});

app.get("/API/carregar_funcionarios_prefeitura", async function(req, res) {
    if (reqq == 0) {
        reqq = 1;
        var funcionarios = require("../../webcrawler/spider");
        res.send("Acionamento manual executado com sucesso!");
        contador();
        funcionarios.todos_os_funcionarios(false, false, function(resultado) {
            console.log("Funcionarios Prefeitura -> Finalizado com sucesso!");
            reqq = 0;
        });
        res.send("Carregando...");
    } else {
        console.log("Aguarde a operação anterior...,\ntempo de execução atual -> " + time.dias + " Dias/" + time.horas + "h " + time.minutos + "min " + time.segundos + "s ");
        res.send("Aguarde a operação anterior...,\ntempo de execução atual -> " + time.dias + " Dias/" + time.horas + "h " + time.minutos + "min " + time.segundos + "s ");
    }
    return;
});

app.get("/API/carregar_funcionarios_camara", async function(req, res) {
    if (reqq == 0) {
        reqq = 1;
        var funcionarios = require("../../webcrawler/prepara_pdf");
        res.send("Acionamento manual executado com sucesso!");
        contador();
        funcionarios.pegar_cargos(function(resultado) {
            console.log("Finalizado com sucesso!");
            reqq = 0;
            res.send("Finalizado com sucesso!");
        });
    } else {
        console.log("Aguarde a operação anterior...,\ntempo de execução atual -> " + time.dias + " Dias/" + time.horas + "h " + time.minutos + "min " + time.segundos + "s ");
        res.send("Aguarde a operação anterior...,\ntempo de execução atual -> " + time.dias + " Dias/" + time.horas + "h " + time.minutos + "min " + time.segundos + "s ");
    }
    return;
});

app.get("/API/carregar_projetos", function(req, res) {
    if (reqq == 0) {
        reqq = 1;
        var projetos = require("../../webcrawler/projetos");
        res.send("Acionamento manual executado com sucesso!");
        contador();
        var resposta = projetos.principal(false, function(resultado) {
            console.log("Finalizado com sucesso!");
            reqq = 0;
            res.send("Finalizado com sucesso!");
        });
    } else {
        console.log("Aguarde a operação anterior...,\ntempo de execução atual -> " + time.dias + " Dias/" + time.horas + "h " + time.minutos + "min " + time.segundos + "s ");
        res.send("Aguarde a operação anterior...,\ntempo de execução atual -> " + time.dias + " Dias/" + time.horas + "h " + time.minutos + "min " + time.segundos + "s ");
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