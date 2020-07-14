const express = require("express");
const appwc = express();
var webcrawler = false;

appwc.get("/API/ligar_webcrawler", function(req, res) {
    if (webcrawler == false) {
        var funcionarios = require("../../webcrawler/spider");
        var projetos = require("../../webcrawler/projetos");
        webcrawler = true;

        funcionarios.todos_os_funcionarios(true, true); //com contagem automatica + funcionarios camara +prefeitura
        projetos.principal(true);
        res.send("...Webcrawler Inicializado...");
    } else {
        res.send("Webcrawler já está ligado");
    }
    return;
});

var port = process.env.PORT || 9000;
appwc.listen(port, function() {
    console.log("Escutando porta " + port);
});

module.exports = appwc, webcrawler;