var request = require("request");
var cheerio = require("cheerio");
var mysql = require("mysql");
const con = require("./con-factory");

const geral = require("./geral");

principal();

function principal() {
  var ano = 2005;
  while (ano <= 2020) {
    request(
      "http://www.cmmc.com.br/projetos/plo.php?pg=0&textfield_num=&textfield_assunto=&textfield_autor=&ano=" +
        ano,
      function (err, response, html) {
        if (err) console.log("Erro:" + err);

        var $ = cheerio.load(html);
        var link;
        var create;
        var equivcoluna = 0; //representa colunas da tabela
        var insert = new Array(0, 0, 0, 0, 0);
        $('tbody tr[title="Clique para abrir o anexo."] a').each(function () {
          if (equivcoluna > 3) {
            //reseta coluna para acessar próxima linha
            insert[4] = link;

            con.query(
              "SELECT FROM projetos WHERE Codigo = '" + insert[0] + "'",
              function (err, rows) {
                if (rows == "") {
                  create = true;
                } else {
                  create = false;
                }
              }
            );

            if (create == true) {
              geral.insere_basico(insert, "projetos"); //funcao de geral.js para insercao simples sem configurações adicionais, recebe vetor com dados e tabela alvo
              console.log("inserido");
            }

            equivcoluna = 0;
            create = false;
          }
          link = $(this).attr("href");
          var celula = $(this).text();
          insert[equivcoluna] = celula.trim();
          imprimeporcoluna(celula, equivcoluna, link);
          equivcoluna++;
        });
      }
    );
    console.log(ano);
    ano++;
  }
}

function imprimeporcoluna(celula, i, link) {
  if (i == 0) {
    console.log("Nº      :" + celula);
  }
  if (i == 1) {
    console.log("Nome    :" + celula);
  }
  if (i == 2) {
    console.log("Assunto :" + celula);
  }
  if (i == 3) {
    console.log("Anotacao:" + celula + "\n");
    console.log("Link    :" + link + "\n");
  }
}
