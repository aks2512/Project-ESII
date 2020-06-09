var axios = require("axios");
var cheerio = require("cheerio");
var mysql = require("mysql");
const qs = require("qs");

const con = mysql.createConnection({
  host: "localhost", // O host do banco. Ex: localhost
  user: "root", // Um usuário do banco. Ex: user
  password: "", // A senha do usuário. Ex: user123
  database: "transparenciamc", // A base de dados a qual a aplicação irá se conectar, deve ser a mesma onde foi executado o Código 1. Ex: node_mysql
});

con.connect((err) => {
  if (err) {
    console.log("Erro connecting to database...", err);
    return;
  }
  console.log("Connection established!");
});

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
return;

async function iniciar_leitura(j, i, estrutura) {
  while (j < i) {
    try {
      var rgf = estrutura["servidores"][j].rgf;
      await requisitar_valores(rgf);
    } catch (err) {
      console.log(err);
    }
    j++;
  }
  return;
}
async function requisitar_valores(rgf) {
  var create = true;
  await con.query(
    "SELECT * FROM funcionarios WHERE rgf = " + rgf,
    (err, rows) => {
      if (err) throw err;
      var resultado = rows;
      if (resultado == "") {
        console.log("Registro nao existe");
        create = false;
      } else {
        console.log("Registro deve ser criado");
        create = true;
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

        console.log("Nome   :" + detalhes.nome);
        console.log("Cargo  :" + detalhes.cargo);
        console.log("Regime :" + detalhes.regime);

        var funcionario = detalhes.nome;
        var cargo = detalhes.cargo;
        var regime = detalhes.regime;
        var referencia = detalhes.referencia;

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

        totalbruto = totalbruto.toFixed(2);

        console.log("\n*Total Bruto    : " + totalbruto + "*");
        console.log("\n*Total Liquido  : " + totaliquido + "*");
        console.log("\n*Total Descontos: " + descontos + "*");
        console.log("-------------------------");

        if (create == false) {
          con.query(
            "INSERT INTO funcionarios VALUES ('NULL','" +
              funcionario +
              "','" +
              cargo +
              "','" +
              "NULL" +
              "','" +
              regime +
              "','" +
              outros +
              "','" +
              totalbruto +
              "','" +
              descontos +
              "','" +
              totaliquido +
              "','" +
              rgf +
              "')"
          );
        } else {
          console.log("ignorado");
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
