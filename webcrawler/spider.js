var axios = require("axios");
var cheerio = require("cheerio");
var mysql = require("mysql");

const con = require("./con-factory");

var geral = require("./geral");

main();

async function main() {
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
        console.log(rgf);
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
        var valores;
        var nomes;

        var contre = detalhes.rendimentos.length || 0;

        if (contre === undefined) {
          console.log(detalhes.rendimentos.length);
          process.exit(0);
        }

        console.log(id);

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

        con.query(
          "SELECT id,modificado FROM funcionarios WHERE rgf = " +
            rgf +
            " LIMIT 1",
          (err, rows, result) => {
            if (err) throw err;
            if (rows == "") {
              console.log("Registro nao existe");
              var dados = new Array(
                null,
                funcionario,
                cargo,
                null,
                regime,
                outros,
                totalbruto,
                descontos,
                totaliquido,
                rgf
              );
              geral.insere_basico(dados, "funcionarios");
            } else {
              console.log("Atualizacao de registro");
              con.query(
                "UPDATE funcionarios SET (NULL ,nome = '" +
                  funcionario +
                  "', cargo = '" +
                  cargo +
                  "',modificado = NULL, regime = '" +
                  regime +
                  "', outros_descontos = '" +
                  outros +
                  "', tbruto = '" +
                  totalbruto +
                  "', tdescontos = '" +
                  descontos +
                  "', tliquido = '" +
                  totaliquido +
                  "') WHERE rgf = '" +
                  rgf +
                  "'"
              );
            }
          }
        );

        for (j = 0; j < contre; j++) {
          nomes = detalhes.rendimentos[j].nome.trim() || "";

          valores = converter_float(detalhes.rendimentos[j].valor) || 0;

          con.query(
            "SELECT nome FROM remuneracoes WHERE rgf = '" +
              rgf +
              "' and nome = '" +
              nomes +
              "'",
            function (err, result) {
              if (result == "") {
                var dados = new Array(rgf, id, null, nomes, valores);
                geral.insere_basico(dados, "remuneracoes");
              } else {
                console.log("Att registro");
                con.query(
                  "UPDATE remuneraoes SET (valor = '" +
                    valor +
                    "') WHERE rgf = '" +
                    rgf +
                    "'"
                );
              }
            }
          );
        }
        for (j = 0; j < contde; j++) {
          nomes = detalhes.descontos[j].nome.trim() || "";

          valores = converter_float(detalhes.descontos[j].valor) || 0;

          var dados = new Array(rgf, id, null, nomes, valores);
          geral.insere_basico(dados, "descontos");
        }
        console.log("Sucesso!");
      });
  } catch (err) {
    console.log(err);
    return 1;
  }
  return 0;
}

function converter_float(numero) {
  numero = numero.replace(".", "");
  numero = parseFloat(numero.replace(",", "."));
  return numero;
}
