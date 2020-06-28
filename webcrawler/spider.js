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

function iniciar_leitura(j, i, estrutura) {
  while (j <= i) {
    try {
      var rgf = estrutura["servidores"][j].rgf;
      requisitar_valores(rgf, j + 1);
    } catch (err) {
      console.log(err);
      process.exit(0);
    }
    j++;
  }
  geral.insere_basico(0, "funcionarios");
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
        var valores = 0.0;
        var nomes = "";
        var outros = 0.0;

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

        //console.log(outros);
        con.query(
          //para evitar erro de sincronia todas as "queries" ficam dentro da query principal
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
                undefined,
                regime,
                outros,
                totalbruto,
                descontos,
                totaliquido,
                rgf
              );
              geral.insere_basico(dados, "funcionarios");
            } else {
              //console.log(rows);
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

          console.log(nomes);

          carrega_detalhes("remuneracoes", rgf, nomes, valores);
        }
        for (j = 0; j < contde; j++) {
          nomes2 = detalhes.descontos[j].nome.trim() || "";

          valores2 = converter_float(detalhes.descontos[j].valor) || 0;

          carrega_detalhes("descontos", rgf, nomes2, valores2);
        }
        console.log("Sucesso!");
      });
  } catch (err) {
    console.log(err);
    return 1;
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

  con.query(
    "SELECT nome FROM " +
      alvo +
      " WHERE rgf = '" +
      rgf +
      "' and nome = '" +
      nomes +
      "'",
    function (err, rows) {
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
        console.log("Att registro 1");
        con.query(
          "UPDATE " +
            alvo +
            " SET (valor = '" +
            valores +
            "') WHERE rgf = '" +
            rgf +
            "' and nome = '" +
            nomes +
            "'"
        );
      }
    }
  );
  return;
}
