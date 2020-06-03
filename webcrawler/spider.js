var axios = require("axios");
var cheerio = require("cheerio");
var fs = require("fs");
axios
  .get("http://www.licitacao.pmmc.com.br/Transparencia/vencimentos2")
  .then((res) => {
    var estrutura = res.data;

    Object.keys(estrutura).forEach(function (chave) {
      var json = estrutura["servidores"];
      for (var i = 0; i < 150; i++) {
        var rgf = json[i].rgf;
        axios
          .get(
            "http://www.licitacao.pmmc.com.br/Transparencia/detalhamento?rgf=" +
              rgf
          )
          .then((res2) => {
            var detalhes = res2.data;

            console.log(rgf);

            console.log("Nome   :" + detalhes.nome);
            console.log("Cargo  :" + detalhes.cargo);
            console.log("Regime :" + detalhes.regime);

            console.log("*Total Bruto:     " + detalhes.totais[0].valor + "*");
            console.log(
              "\n*Total Liquido:   " + detalhes.totais[2].valor + "*"
            );

            if (detalhes.totais[2].valor === undefined) {
              fs.appendFile(
                "debug.txt",
                detalhes.totais[2].valor + " - " + rgf
              );
            }

            rgf = 0;

            var valores;
            var nomes;
            var cont = detalhes.rendimentos.length;

            for (j = 0; j < cont; j++) {
              nomes = detalhes.rendimentos[j].nome;
              valores = detalhes.rendimentos[j].valor;
              console.log(nomes + ": " + valores);
            }
            var cont = detalhes.rendimentos.length;
            console.log(
              "\n*Total Descontos: " + detalhes.totais[1].valor + "*"
            );
            for (j = 0; j < cont; j++) {
              nomes = detalhes.rendimentos[j].nome;
              valores = detalhes.rendimentos[j].valor;
              console.log(nomes + ": " + valores);
            }

            console.log(
              "\n*Outros Descontos:" + detalhes.outros[0].valor + "*"
            );
            console.log("-------------------------");
          });
      }
    });
  });
