var axios = require("axios");
var cheerio = require("cheerio");
<<<<<<< HEAD
var mysql = require("mysql");
const qs = require("qs");

const con = mysql.createConnection({
  host: "localhost", // O host do banco.
  user: "root", // Um usuário do banco.
  password: "", // A senha do usuário.
  database: "transparenciamc", // A base de dados a qual a aplicação irá se conectar, deve ser a mesma onde foi executado o Código 1. Ex: node_mysql
});

con.connect((err) => {
  if (err) {
    console.log("Erro connecting to database...", err);
    return;
  }
  console.log("Connection established!");
});

main();

async function main() {
  axios
    .get("http://www.licitacao.pmmc.com.br/Transparencia/vencimentos2")
    .then((res) => {
      var estrutura = res.data;

      delregistro();
      var i = estrutura["servidores"].length - 1;
      var j = 0;
      iniciar_leitura(j, i, estrutura);
    })
    .catch((err) => {
      throw new Error(err);
    });
}

async function delregistro() {
  await con.query("DELETE FROM remuneracoes");
  con.query("ALTER TABLE remuneracoes AUTO_INCREMENT = 1 ");

  await con.query("DELETE FROM descontos");
  con.query("ALTER TABLE descontos AUTO_INCREMENT = 1 ");

  await con.query("DELETE FROM funcionarios");
  con.query("ALTER TABLE funcionarios AUTO_INCREMENT = 1 ");
}

async function iniciar_leitura(j, i, estrutura) {
  while (j <= i) {
    console.log(i);
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
  var create = true;
  var id = k;
  con.query(
    "SELECT id FROM funcionarios WHERE rgf = " + rgf + " LIMIT 1",
    (err, rows, result) => {
      if (err) throw err;
      if (rows == "") {
        console.log("Registro nao existe");
        create = true;
      } else {
        console.log("Atualizacao de registro");
        create = false;
        return;
      }
    }
  );

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

        if (create == true) {
          con.query(
            "INSERT INTO funcionarios VALUES (NULL ,'" +
              funcionario +
              "','" +
              cargo +
              "',NULL,'" +
              regime +
              "','" +
              outros +
              "','" +
              totalbruto +
              "','" +
              descontos +
              "','" +
              totaliquido +
              "' ,'" +
              rgf +
              "')"
          );
          console.log("Sucesso!");
        } else {
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
            "'";
          console.log("Sucesso!");
        }
        console.log(id);
        for (j = 0; j < contre; j++) {
          nomes = detalhes.rendimentos[j].nome.trim() || "";

          valores = converter_float(detalhes.rendimentos[j].valor) || 0;

          con.query(
            "INSERT INTO remuneracoes VALUES ('" +
              rgf +
              "','" +
              id +
              "',NULL,'" +
              nomes +
              "','" +
              valores +
              "')"
          );
        }
        for (j = 0; j < contde; j++) {
          nomes = detalhes.descontos[j].nome.trim() || "";

          valores = converter_float(detalhes.descontos[j].valor) || 0;

          con.query(
            "INSERT INTO descontos VALUES ('" +
              rgf +
              "','" +
              id +
              "',NULL,'" +
              nomes +
              "','" +
              valores +
              "')"
          );
        }
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
=======
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
>>>>>>> a69224a839b7e4de301e2dd5e6ee79776c0ef8f8
