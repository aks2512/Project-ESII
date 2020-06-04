var request = require("request");
var cheerio = require("cheerio");

request(
  "http://www.cmmc.com.br/projetos/plo.php?pg=0&textfield_num=&textfield_assunto=&textfield_autor=&ano=2020",
  function (err, response, html) {
    if (err) console.log("Erro:" + err);

    var $ = cheerio.load(html);
    var equivcoluna = 0; //representa colunas da tabela
    $('tbody tr[title="Clique para abrir o anexo."] a').each(function () {
      if (equivcoluna > 3) {
        //reseta coluna para acessar próxima linha
        equivcoluna = 0;
      }
      var celula = $(this).text();
      imprimeporcoluna(celula, equivcoluna);
      equivcoluna++;
    });
  }
);

function imprimeporcoluna(celula, i) {
  if (i == 0) {
    console.log("Nº      :" + celula);
  }
  if (i == 1) {
    console.log("Nome    :" + celula);
  }
  if (i == 2) {
    console.log("Assunto :\n" + celula);
  }
  if (i == 3) {
    console.log("Anotacao:" + celula + "\n");
  }
}
