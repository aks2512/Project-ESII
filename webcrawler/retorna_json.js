var mysql = require("mysql2");
var con = require("./con-factory");

module.exports = {
    func_prefeitura(callback) {
        var resultado = con.query("SELECT * FROM funcionarios_prefeitura", function(err, results) {
            callback(results);
        });

    },
    func_camara(callback) {
        var resultado = con.query("SELECT * FROM funcionarios_camara", function(err, results) {
            callback(results);
        });

    },
    projetos(callback) {
        var resultado = con.query("SELECT * FROM projetos", function(err, results) {
            callback(results);
        })

    }
}