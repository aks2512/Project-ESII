var mysql = require("mysql");
const { connect } = require("http2");

const del = mysql.createConnection({
  host: "localhost", // O host do banco.
  user: "root", // Um usuário do banco.
  password: "", // A senha do usuário.
  database: "transparenciamc", // A base de dados a qual a aplicação irá se conectar, deve ser a mesma onde foi executado o Código 1. Ex: node_mysql
});

deletar();

async function deletar() {
  del.connect((err) => {
    if (err) {
      console.log("Erro connecting to database...", err);
      return;
    }
    console.log("Connection established!");
  });

  del.query("DELETE FROM remuneracoes");
  del.query("ALTER TABLE remuneracoes AUTO_INCREMENT = 1 ");

  del.query("DELETE FROM descontos");
  del.query("ALTER TABLE descontos AUTO_INCREMENT = 1 ");

  del.query("DELETE FROM funcionarios");
  del.query("ALTER TABLE funcionarios AUTO_INCREMENT = 1 ");

  del.query("DELETE FROM projetos");
  del.query("ALTER TABLE projetos AUTO_INCREMENT = 1 ");

  del.end();
}
