var axios = require("axios");
var cheerio = require("cheerio");
const mysql = require("mysql2");
const con_main = require("./con-factory");
var carregar_pdf = require("./prepara_pdf");
var segundos_exec = 0;
var geral = require("./geral");
var requisicoes = 0;
var finalizacoes = 0;
var self = require("./spider");

module.exports = {
  async todos_os_funcionarios(ac_automatico, geral, callback) {
    return main(ac_automatico, geral, callback);
  }
}

async function main(ac_automatico, geral, callback) {
  var segundos = setInterval(function() {
    segundos_exec++;
  }, 1000)
  var prepara_pdf = require("./prepara_pdf");

  if (geral) {
    await prepara_pdf.pegar_cargos();
  }

  axios
    .get("http://www.licitacao.pmmc.com.br/Transparencia/vencimentos2")
    .then((res) => {
      var estrutura = res.data;

      var i = estrutura["servidores"].length - 1;
      var j = 0;
      iniciar_leitura(j, i, estrutura);
    })
    .catch((err) => {
      throw new Error(err);
    });

  var seg = 59;
  var min = 59;
  var hora = 23;
  var dia = 1;

  con_main.on("acquire", function() {
    requisicoes++;
  });
  con_main.on("release", function() {
    setTimeout(function() {
      finalizacoes++;
      //console.log(finalizacoes + ":" + requisicoes);
      if (finalizacoes == requisicoes) {
        //quando todas as requisições estiverem acabadas


        if (ac_automatico == true) {
          var int = setInterval(function() {
            seg--;

            if (seg == -1) {
              seg = 59;
              min--;
            }
            if (min == -1) {
              min = 59;
              hora--;
            }
            if (hora == -1) {
              hora = 23;
              dia--;
            }
            if (dia <= -1) {
              dia = 29;
              self.todos_os_funcionarios(true, true);
              clearInterval(int);
            }
            console.clear();
            console.log(
              "Funcionarios -> Próxima execução em: " +
              dia +
              " dia(s) " +
              hora +
              "h " +
              min +
              " min " +
              seg +
              " s"
            );
          }, 1);
        } else {
          console.log("Script finalizado, tempo de execução:" + segundos_exec + "s");
          clearInterval(int);
          clearInterval(segundos);
          callback(1);
        }
      }
    }, 10000); //atraso para que o programa conssiga gerar todas as requisicoes
  });
}

async function iniciar_leitura(j, i, estrutura) {
  while (j <= i) {
    try {
      var rgf = estrutura["servidores"][j].rgf;
      await requisitar_valores(rgf, j + 1);
    } catch (err) {
      console.log(err);
      process.exit(0);
    }
    j++;
  }
}

async function requisitar_valores(rgf, k) {
  var id = k;
  try {
    await axios
      .get(
        "http://www.licitacao.pmmc.com.br/Transparencia/detalhamento?rgf=" + rgf
      )
      .then((res2) => {
        //console.log(rgf);
        var detalhes = res2.data;

        //console.log("Nome   :" + detalhes.nome);
        //console.log("Cargo  :" + detalhes.cargo);
        //console.log("Regime :" + detalhes.regime);

        var funcionario = detalhes.nome;
        var cargo = detalhes.cargo;
        var regime = detalhes.regime;
        var referencia = detalhes.referencia;

        var totalbruto = 0.0;
        var totaliquido = 0.0;
        var descontos = 0.0;
        var valores = 0.0;
        var nomes = "";
        var outros = 0.0;

        var contre = detalhes.rendimentos.length || 0;

        if (contre === undefined) {
          //console.log(detalhes.rendimentos.length);
          process.exit(0);
        }

        //console.log(id);

        //console.log("\nRemuneracoes");
        for (j = 0; j < contre; j++) {
          nomes = detalhes.rendimentos[j].nome.trim() || "";

          valores = converter_float(detalhes.rendimentos[j].valor) || 0;

          //console.log(nomes + ": " + valores);
          totalbruto = totalbruto + valores;
        }

        //console.log("\nDescontos");
        if (detalhes.descontos) {
          var contde = detalhes.descontos.length;
          for (j = 0; j < contde; j++) {
            nomes = detalhes.descontos[j].nome.trim() || "";

            valores = converter_float(detalhes.descontos[j].valor) || 0;

            //console.log(nomes + ": " + valores);
            descontos = descontos + valores;
          }
        }

        outros = converter_float(detalhes.outros[0].valor) || 0;

        //console.log("\n*Outros Descontos:" + outros + "*");

        descontos = (descontos + outros).toFixed(2) || 0;

        totaliquido = (totalbruto - descontos).toFixed(2);

        totalbruto = totalbruto.toFixed(2);

        //console.log("\n*Total Bruto    : " + totalbruto + "*");
        //console.log("\n*Total Liquido  : " + totaliquido + "*");
        //console.log("\n*Total Descontos: " + descontos + "*");
        //console.log("-------------------------");

        //console.log(outros);
        con_main.query(
          //para evitar erro de sincronia todas as "queries" ficam dentro da query principal
          "SELECT * FROM funcionarios_prefeitura WHERE rgf = " +
          rgf +
          " LIMIT 1",
          (err, rows, result) => {
            if (err) throw err;
            if (rows == "" || rows[0] === undefined) {
              //console.log("Registro nao existe");
              var dados = new Array(
                null,
                funcionario,
                cargo,
                undefined,
                regime,
                outros,
                totalbruto,
                descontos,
                totaliquido,
                rgf
              );

              geral.insere_basico(dados, "funcionarios_prefeitura");
            } else {
              console.log(rows);
              con_main.query(
                "UPDATE funcionarios_prefeitura SET nome = '" +
                funcionario +
                "', cargo = '" +
                cargo +
                "', modificado = NULL, regime = '" +
                regime +
                "', outros_descontos = '" +
                outros +
                "', tbruto = '" +
                totalbruto +
                "', tdesconto = '" +
                descontos +
                "', tliquido = '" +
                totaliquido +
                "' WHERE rgf = '" +
                rgf +
                "'",
                function(err) {
                  if (err) throw err;
                });
            }
          }
        );
        for (j = 0; j < contre; j++) {
          nomes = detalhes.rendimentos[j].nome.trim() || "";

          valores = converter_float(detalhes.rendimentos[j].valor) || 0;

          //console.log(nomes);

          carrega_detalhes("remuneracoes", rgf, nomes, valores);
        }
        for (j = 0; j < contde; j++) {
          nomes2 = detalhes.descontos[j].nome.trim() || "";

          valores2 = converter_float(detalhes.descontos[j].valor) || 0;

          carrega_detalhes("descontos", rgf, nomes2, valores2);
        }
      });
  } catch (err) {
    console.log(err);
  }
  return;
}

function converter_float(numero) {
  numero = numero.replace(".", "");
  numero = parseFloat(numero.replace(",", "."));
  return numero;
}

async function carrega_detalhes(alvo, rgf, nomes, valores) {
  var check = false;

  con_main.query(
    "SELECT nome FROM " +
    alvo +
    " WHERE rgf = '" +
    rgf +
    "' and nome = '" +
    nomes +
    "'",
    function(err, rows) {
      var result = rows[0];
      if (result === undefined) {
        check = false;
      } else {
        check = true;
      }
      if (check == false) {
        var dados = new Array(rgf, null, nomes, valores);

        geral.insere_basico(dados, alvo);
      } else {
        con_main.query(
          "UPDATE " +
          alvo +
          " SET valor = '" +
          valores +
          "' WHERE rgf = '" +
          rgf +
          "' and nome = '" +
          nomes +
          "'",
          function(err) {
            if (err) throw err;
          });
      }
    }
  );
  return;
}