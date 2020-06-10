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
  await con.query("DELETE FROM funcionarios");
  con.query("ALTER TABLE funcionarios AUTO_INCREMENT = 1 ");
}

async function iniciar_leitura(j, i, estrutura) {
  while (j < i) {
    try {
      var rgf = estrutura["servidores"][j].rgf;
      await requisitar_valores(rgf);
    } catch (err) {
      console.log(err);
      return;
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

        try {
          var cont = detalhes.rendimentos.length || 0;
        } catch (err) {
          console.log(err);
          return;
        }

        console.log("\nRemuneracoes");
        for (j = 0; j < cont; j++) {
          nomes = detalhes.rendimentos[j].nome || "";

          valores = converter_float(detalhes.rendimentos[j].valor) || 0;

          con.query(
            "INSERT INTO remuneracoes VALUES '" +
              rgf +
              ",NULL,'" +
              nomes +
              "','" +
              valores +
              "'"
          );
          console.log(nomes + ": " + valores);
          totalbruto = totalbruto + valores;
        }

        try {
          var cont = detalhes.descontos.length || 0;
        } catch (err) {
          console.log(err);
          return;
        }

        console.log("\nDescontos");
        for (j = 0; j < cont; j++) {
          nomes = detalhes.descontos[j].nome || "";

          valores = converter_float(detalhes.descontos[j].valor) || 0;

          con.query(
            "INSERT INTO descontos VALUES '" +
              rgf +
              ",NULL,'" +
              nomes +
              "','" +
              valores +
              "'"
          );
          console.log(nomes + ": " + valores);
          descontos = descontos + valores;
        }

        outros = converter_float(detalhes.outros[0].valor) || 0;

        console.log("\n*Outros Descontos:" + outros + "*");

        descontos = (descontos + outros).toFixed(2) || 0;

        totaliquido = (totalbruto - descontos).toFixed(2);

        totalbruto = totalbruto.toFixed(2);

        console.log("\n*Total Bruto    : " + totalbruto + "*");
        console.log("\n*Total Liquido  : " + totaliquido + "*");
        console.log("\n*Total Descontos: " + descontos + "*");
        console.log("-------------------------");

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

return;
