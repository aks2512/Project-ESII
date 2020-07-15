var request = require("request");
var cheerio = require("cheerio");
const crawler = require("crawler-request"); //extensão avançada para analisar arquivos online
var capturar_cargos = require("./prepara_pdf");
const mysql = require("mysql2");
const fs = require("fs");
const geral = require("./geral");
const con = require("./con-factory");
const {
  resolve
} = require("bluebird");
var regex = /([0-9 .]*)([\nA-Z- ÃÁÕÇÉ]*)(CARGO[\nA-Z- ÃÁÕÇÉ]*)(-?\d*\.?\d*,\d{2})\n*?(-?\d*\.?\d*,\d{2}) *?\n*?(-?\d*\.?\d*,\d{2})\n*?(-?\d*\.?\d*,\d{2}) *?(-?\d*\.?\d*,\d{2}) *?\n*?(-?\d*\.?\d*,\d{2}) *?\n*?(-?\d*\.?\d*,\d{2}) *?\n*?(-?\d*\.?\d*,\d{2})/g; //codigo de referencia para a expressão regular

module.exports = {
  principal(cargos_teste) {
    var promise;
    var q = 0;
    var finalizacoes = 0;
    var promise_arr = new Array();
    var funcionarios = new Array();
    request(
      "http://www.cmmc.com.br/transparencia/exibe_arquivos.php?categ=7",
      function(err, response, html) {
        if (err) console.log("Erro:" + err);

        var $ = cheerio.load(html);
        var item = $('th[width="400"]').find("a").attr("href"); //pega primeiro link de pdf da pagina

        crawler(item).then(async function(response) {
          var texto = response.text;
          var remuneracoes = "";
          var descontos = "";
          var i = 0;
          var j = 0;
          var k = 0;
          while (j < cargos_teste.length) {
            while (k < cargos_teste[j].length) {
              queryok = false;
              regex = new RegExp(
                "([0-9 .]*)([\\nA-Z- ÃÁÕÇÉ]*)(" +
                cargos_teste[j][k] +
                "[\\nA-Z- ÃÁÕÇÉ]*)(-?\\d*.?\\d*,\\d{2})\n*?(-?\\d*\\.?\\d*,\\d{2}) *?\\n*?(-?\\d*\\.?\\d*,\\d{2})\\n*?(-?\\d*\\.?\\d*,\\d{2}) *?(-?\\d*\\.?\\d*,\\d{2}) *?\\n*?(-?\\d*\\.?\\d*,\\d{2}) *?\\n*?(-?\\d*\\.?\\d*,\\d{2}) *?\\n*?(-?\\d*\\.?\\d*,\\d{2})",
                "g"
              );

              var writefile = 0;

              while ((busca = regex.exec(texto)) != null) {
                funcionarios[i] = new Array(
                  busca[1].replace(" ", "").replace(".", ""), //RGF
                  null, //id
                  busca[2].replace(/\n/g, ""), //Nome
                  busca[3].replace(/\n/g, ""), //Cargo
                  converter_float(busca[4]), //Vencimento Base
                  converter_float(busca[5]), //Outros Vencimentos
                  converter_float(busca[7]), //Previdência
                  converter_float(busca[9]), //Outros Descontos
                  converter_float(busca[6]), //Total Bruto
                  converter_float(busca[11]), //Total Liquido
                  converter_float(busca[10]), //Total Descontos
                  converter_float(busca[8]), //IRRF
                  null
                );

                writefile = writefile + "\nRGF  :" + funcionarios[i][0];
                writefile = writefile + "\nNome :" + funcionarios[i][2];
                writefile = writefile + "\nCargo:" + funcionarios[i][3];
                writefile =
                  writefile + "\nVencimento Base   :" + funcionarios[i][4];
                writefile =
                  writefile + "\nOutros Vencimentos:" + funcionarios[i][5];
                writefile =
                  writefile + "\nTotal Bruto       :" + funcionarios[i][6];
                writefile =
                  writefile + "\nPrevidencia       :" + funcionarios[i][7];
                writefile =
                  writefile + "\nIRRF              :" + funcionarios[i][8];
                writefile =
                  writefile + "\nOutros Descontos  :" + funcionarios[i][9];
                writefile =
                  writefile + "\nTotal Descontos   :" + funcionarios[i][10];
                writefile =
                  writefile + "\nTotal Liquido     :" + funcionarios[i][11];
                writefile =
                  writefile +
                  "\n" +
                  "----------------------------------------------------------------";
                promise = await new Promise((res, rej) => {
                  con.query(
                    "SELECT * FROM funcionarios_camara WHERE rgf = '" +
                    funcionarios[i][0] +
                    "'",
                    async function(err, rows, results) {
                      var check = rows || 0;
                      if (check == (undefined || 0)) {
                        geral.insere_basico(
                          funcionarios[i],
                          "funcionarios_camara"
                        );
                        console.log(funcionarios[i]);
                        res(0);
                      } else {
                        console.log(funcionarios[i]);
                        con.query(
                          "UPDATE funcionarios_camara SET nome = '" +
                          funcionarios[i][2] +
                          "', cargo = '" +
                          funcionarios[i][3] +
                          "', vencimento_base = '" +
                          funcionarios[i][4] +
                          "', outros_vencimentos = '" +
                          funcionarios[i][5] +
                          "', previdencia = '" +
                          funcionarios[i][6] +
                          "', outros_descontos = '" +
                          funcionarios[i][7] +
                          "', tbruto = '" +
                          funcionarios[i][8] +
                          "', tliquido = '" +
                          funcionarios[i][9] +
                          "', tdesconto = '" +
                          funcionarios[i][10] +
                          "', irrf = '" +
                          funcionarios[i][11] +
                          "',Modificado = NULL WHERE rgf = '" +
                          funcionarios[i][0] +
                          "'",
                          function(err, results) {
                            if (err) throw err;
                            console.log(results);
                            res(0);
                          }
                        );
                      }
                    }
                  );
                });

                promise_arr.push(promise);
                i++;
              }
              i = 0;
              k++;
            }
            k = 0;
            j++;
          }
        });
      }
    );
    Promise.all(promise).then(function() {
      con.end();
    });
  },
};

function converter_float(numero) {
  numero = numero.replace(".", "");
  numero = parseFloat(numero.replace(",", "."));
  return numero;
}