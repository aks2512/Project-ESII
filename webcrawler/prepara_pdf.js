var request = require("request");
var cheerio = require("cheerio");
const crawler = require("crawler-request"); //extensão avançada para analisar arquivos online
var funcionarios_pdf = require("./pdf");
const fs = require("fs");
const con = require("./con-factory");
var regex = /(CARGO)([\nA-Z- ÃÁÕÇÉ][\nA-Z- ÃÁÕÇÉ]*)/g; //codigo de referencia para a expressão regular

module.exports = {
  async pegar_cargos() {
    var set = true;
    await new Promise((res, rej) => {
      request(
        "http://www.cmmc.com.br/transparencia/exibe_arquivos.php?categ=7",
        function(err, response, html) {
          if (err) console.log("Erro:" + err);

          var cargos_teste = new Array( //cargos que serão tratados pelo código para obter o cargo completo, também ajuda a eliminar duplicação de funcionario devido a um mesmo cargo ser identificado no meio de outro ex: Chefe de (...), Procurador Chefe 
            "ASSESSOR",
            "ATENDENTE",
            "ASSISTENTE",
            "AUXILIAR",
            "AGENTE",
            "CHEFE",
            "CONTADOR",
            "CONSULTOR",
            "DIRETOR",
            "ENCARREGADO",
            "MOTORISTA",
            "JORNALISTA",
            "PRESIDENTE",
            "PROCURADOR",
            "PROGRAMADOR",
            "SECRETARIO",
            "TÉCNICO",
            "TELEFONISTA",
            "TESOUREIRO",
            "VEREADOR",
            "VIGILANTE"

          );
          var cargos_completos = new Array();
          var $ = cheerio.load(html);
          var item = $('th[width="400"]').find("a").attr("href"); //pega primeiro link de pdf da pagina

          crawler(item).then(function(response) {
            var texto = response.text;
            var busca;
            var cont = 0;
            var remuneracoes = "";
            var descontos = "";

            var i = 0;
            var j = 0;
            var vetor_cargos = new Array();

            //obs: replace(/\n/,"") não sera mais usado ao escrever o vetor que carrega o nome completo dos cargos, pois caso contrário o mesmo não poderá ser encontrado no pdf.js posteriormente

            while (j < cargos_teste.length) {
              cargos_completos[j] = new Array();

              var funcionarios = new Array();
              regex = new RegExp(
                "(" + cargos_teste[j] + ")([\n ][\nA-Z- ÃÁÕÇÉÊ]*)", //Pega espaço apos o cargo teste,e caracteres apos espaço
                "g"
              );
              vetor_cargos[cargos_teste[j]] = new Array();
              while ((busca = regex.exec(texto)) != null) {
                if (
                  //pega apenas aqueles subcargos que forem diferentes aos que ja existem no vetor
                  vetor_cargos[cargos_teste[j]].indexOf(busca[2]) <
                  0
                ) {

                  vetor_cargos[cargos_teste[j]][cont] = busca[2];
                  cont++;
                  var reregex = /[\n ]/; //avalia pelo menos três digitos apos o cargo inicial
                  if (reregex.test(busca[2])) {
                    //console.log(busca[1] + busca[2]);
                    cargos_completos[j][cont - 1] = busca[1] + busca[2];
                  }
                }


              }
              if (cargos_completos[j][0] === undefined) { //se cargo nao possue espaço apos cargo teste(inicio da string cargo), é porque ele é cargo simples e deve ser gravado como tal
                cargos_completos[j][0] = cargos_teste[j];
              }
              cont = 0;

              j++;
            }
            console.log(cargos_completos);
            fs.writeFileSync("cargos.txt", vetor_cargos);

            funcionarios_pdf.principal(cargos_completos);

            res(0);

          });
        }
      );
    })
  }
}