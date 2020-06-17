const mysql = require("mysql");
const con = require("./con-factory");

module.exports = {
  insere_basico(dados, alvo) {
    tamanho_query = dados.length || 0;

    if (tamanho_query == 0) {
      throw "Tamanho do vetor invalido";
    }

    var valores = "'" + dados[0] + "'";
    var i = 1;

    while (i < tamanho_query) {
      valores = valores + ",'" + dados[i] + "'";
      i++;
    }

    con.query("INSERT INTO " + alvo + " VALUES (" + valores + ")", function (
      err
    ) {
      if (err) throw err;
    });
  },
};
