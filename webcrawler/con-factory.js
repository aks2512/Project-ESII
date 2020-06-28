var mysql = require("mysql");

const con = mysql.createPool({
  timeout: 2500,
  connectionLimit: 10,
  host: "localhost", // O host do banco.
  user: "root", // Um usuário do banco.
  password: "", // A senha do usuário.
  database: "projectteste", // A base de dados a qual a aplicação irá se conectar, deve ser a mesma onde foi executado o Código 1. Ex: node_mysql
});

module.exports = con;
