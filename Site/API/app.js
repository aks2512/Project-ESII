const express = require("express");
const app = express();

app.get("/API", function(req, res) {
    res.json({
        aviso: "ok!"
    });
})

app.get("/API/carregar_funcionarios_geral", function(req, res) {
    var funcionarios = require("../../webcrawler/spider");
    funcionarios.todos_os_funcionarios(false, true)
    res.json({
        aviso: "ok!"
    });
})

app.get("/API/carregar_funcionarios_prefeitura", function(req, res) {
    var funcionarios = require("../../webcrawler/spider")
})

app.get("/API/carregar_funcionarios_camara", function(req, res) {
    var funcionarios = require("../../webcrawler/prepara_pdf")
    funcionarios.pegar_cargos();
    res.json({
        aviso: "ok!"
    });
})

app.get("/API/projetos", function(req, res) {
    res.json({
        aviso: "ok!"
    });
})

app.get("/API/select_funcionarios_prefeitura", function(req, res) {
    var select = require("../../webcrawler/retorna_json");
    var resultado = select.func_prefeitura(function(resultado) {
        res.json(resultado);
    });

})

app.get("/API/select_funcionarios_camara", function(req, res) {
    var select = require("../../webcrawler/retorna_json");
    var resultado = select.func_camara(function(resultado) {
        res.json(resultado);
    });

})

app.get("/API/select_projetos", function(req, res) {
    var select = require("../../webcrawler/retorna_json");
    var resultado = select.projetos(function(resultado) {
        res.json(resultado);
    });
})

app.get("/")

var port = process.env.PORT || 3000;
app.listen(port, function() {
    console.log("Escutando porta " + port);
})