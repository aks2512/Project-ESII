var request = require("request");
var cheerio = require("cheerio");
const crawler = require("crawler-request"); //extensão avançada para analisar arquivos online
const fs = require("fs");

request(
  "http://www.cmmc.com.br/transparencia/exibe_arquivos.php?categ=7",
  function (err, response, html) {
    if (err) console.log("Erro:" + err);

    var $ = cheerio.load(html);
    var item = $('th[width="400"]').find("a").attr("href"); //pega primeiro link de pdf da pagina

    console.log(item);

    crawler(item).then(function (response) {
      console.log(response.text);
      fs.writeFileSync("politicos.txt", response.text);
    });
  }
);
