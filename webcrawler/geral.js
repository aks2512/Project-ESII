const mysql = require("mysql");
const con = require("./con-factory");

module.exports = {
  insere_basico(dados, alvo) {
    tamanho_query = dados.length || 0;

    if (tamanho_query == 0) {
      throw "Erro: Vetor está vazio";
    }

    con.query("INSERT INTO " + alvo + " VALUES (?)", [dados], function (err) {
      if (err) {
        //console.log(err);
        //não está sendo usada interrupção pois erro de duplicação é recorrente e prejudica o uso do script
        //duplicação de chave primária é automaticamente resolvida pelo phpmyadmin, então pode ser ignorada nessa função no estado de produção
      }
    });
  },
};
