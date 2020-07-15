const express = require("express");
const appwc = express();
var webcrawler = false;


var time = new Object();
time.segundos = 0;
time.minutos = 0;
time.horas = 0;
time.dias = 0;
var pro = 0;
var func = 0;
appwc.use(function(req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});

appwc.get("/API/ligar_webcrawler", function(req, res) {

    setInterval(function() {
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
    if (webcrawler == false) {
        var funcionarios = require("../../webcrawler/spider");
        var projetos = require("../../webcrawler/projetos");
        webcrawler = true;

        funcionarios.todos_os_funcionarios(true, true, function(resultado) {
            func++;
            console.log(resultado);
        }); //com contagem automatica + funcionarios camara +prefeitura
        projetos.principal(true, function(resultado) {
            pro++;
            console.log(resultado);
        });
        res.send("...Webcrawler Inicializado...");
    } else {
        console.log("Webcrawler já está ligado -> Tempo de execução " + time.dias + " Dias / " + time.horas + "h " + time.minutos + "min " + time.segundos + "s");
        res.send("Webcrawler já está ligado -> Tempo de execução " + time.dias + " Dias / " + time.horas + "h " + time.minutos + "min " + time.segundos + "s\n" + "Executou com sucesso:\n" + "Projetos:" + pro + " vezes\nFuncionarios:" + func + " vezes");
    }
});

var port = process.env.PORT || 9000;
appwc.listen(port, function() {
    console.log("Escutando porta " + port);
});

module.exports = appwc, webcrawler;