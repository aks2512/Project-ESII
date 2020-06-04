var axios = require("axios");
var cheerio = require("cheerio");
var fs = require("fs");
axios
  .get("http://www.licitacao.pmmc.com.br/Transparencia/vencimentos2")
  .then((res) => {
    var estrutura = res.data;

    Object.keys(estrutura).forEach(function (chave) {
      var json = estrutura["servidores"];
      for (var i = 0; i < 5; i++) {
        var rgf = json[i].rgf;
        axios
          .get(
            "http://www.licitacao.pmmc.com.br/Transparencia/detalhamento?rgf=" +
              rgf
          )
          .then((res2) => {
            var detalhes = res2.data;

            console.log("Nome   :" + detalhes.nome);
            console.log("Cargo  :" + detalhes.cargo);
            console.log("Regime :" + detalhes.regime);

            if (detalhes.totais[2].valor === undefined) {
              fs.appendFile(
                "debug.txt",
                detalhes.totais[2].valor + " - " + rgf
              );
            }

            rgf = 0;
            var totalbruto = 0.0;
            var totaliquido = 0.0;
            var descontos = 0.0;
            var valores;
            var nomes;
            var cont = detalhes.rendimentos.length;

            console.log("\nRemuneracoes");
            for (j = 0; j < cont; j++) {
              nomes = detalhes.rendimentos[j].nome;

              valores = converter_float(detalhes.rendimentos[j].valor);

              console.log(nomes + ": " + valores);
              totalbruto = totalbruto + valores;
            }

            var cont = detalhes.descontos.length;

            console.log("\nDescontos");
            for (j = 0; j < cont; j++) {
              nomes = detalhes.descontos[j].nome;

              valores = converter_float(detalhes.descontos[j].valor);

              console.log(nomes + ": " + valores);
              descontos = descontos + valores;
            }

            outros = converter_float(detalhes.outros[0].valor);

            console.log("\n*Outros Descontos:" + outros + "*");

            descontos = (descontos + outros).toFixed(2);

            totaliquido = (totalbruto - descontos).toFixed(2);

            console.log("\n*Total Bruto    : " + totalbruto + "*");
            console.log("\n*Total Liquido  : " + totaliquido + "*");
            console.log("\n*Total Descontos: " + descontos + "*");
            console.log("-------------------------");
          });
      }
    });
  });

function converter_float(numero) {
  numero = numero.replace(".", "");
  numero = parseFloat(numero.replace(",", "."));
  return numero;
}
