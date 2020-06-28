var request = require("request-promise");
var cheerio = require("cheerio");
var mysql = require("mysql");
const fs = require("fs");
const con = require("./con-factory");

const geral = require("./geral");
const { insere_basico } = require("./geral");

async function principal() {
  var tipodelei = new Array(
    "leiordinaria",
    "leicomplementar",
    "pelo",
    "decreto legislativo",
    "resolução"
  );
  var tipourl = new Array("plo", "plc", "pelo", "pdl", "pr");
  var projetos = new Array();

  var insert = new Array(0, 0, 0, 0, 0, 0, 0);
  var cont = 0;
  var tipo = 0;
  while (tipo < tipourl.length) {
    var ano = 2005;
    console.log(tipodelei[tipo]);
    while (ano <= 2020) {
      var paginas = 0;
      projetos[cont] = new Array();
      var k = 0;
      await request(
        //Esse request mapeia a quantidade de paginas das tabelas de cada ano
        "http://www.cmmc.com.br/projetos/" +
          tipourl[tipo] +
          ".php?pg=0&textfield_num=&textfield_assunto=&textfield_autor=&ano=" +
          ano,
        async function (err, response, html) {
          var $ = await cheerio.load(html);

          $(".pg").each(function () {
            paginas++;
          });
        }
      );
      var linhas = 0;
      while (k <= paginas) {
        await request(
          //Esse request chama as paginas do site usando as "paginas da tabela" como referencia
          "http://www.cmmc.com.br/projetos/" +
            tipourl[tipo] +
            ".php?pg=" +
            k +
            "&textfield_num=&textfield_assunto=&textfield_autor=&ano=" +
            ano,
          function (err, response, html) {
            if (err) console.log("Erro:" + err);
            var $ = cheerio.load(html);
            var link;

            var colunas = 0;

            $('tbody tr[title="Clique para abrir o anexo."] a').each(
              function () {
                //imprimeporcoluna(insert[colunas], colunas, link);//codigo para exibir dados via texto
                insert[colunas] = $(this).text();
                link = $(this).attr("href") || link;

                colunas++;
                if (colunas == 4) {
                  colunas = 0;
                  insert[4] = link;
                  insert[5] = ano;
                  insert[6] =
                    parseInt(insert[0].replace("/", "") - (ano - 2001)) / 100;
                  projetos[cont][linhas] = new Array(
                    tipodelei[tipo],
                    tipourl[tipo] + ":" + insert[0],
                    insert[1],
                    insert[2],
                    insert[3],
                    insert[4],
                    insert[5],
                    insert[6],
                    null
                  );
                  linhas++;
                }
              }
            );
          }
        );
        k++;
      }
      console.log(ano);
      cont++;
      ano++;
    }
    cont--; //correção do ultimo incremento de cont
    var j = 0;
    console.log(projetos.length);
    console.log(projetos);
    while (j <= cont) {
      var linhas = 0;
      while (linhas < projetos[j].length) {
        insere(projetos[j][linhas]);
        linhas++;
      }
      j++;
    }
    tipo++;
  }
}

function imprimeporcoluna(celula, i, link) {
  if (i == 0) {
    console.log("Nº      :" + celula);
  }
  if (i == 1) {
    console.log("Nome    :" + celula);
  }
  if (i == 2) {
    console.log("Assunto :" + celula);
  }
  if (i == 3) {
    console.log("Anotacao:" + celula);
    console.log("Link    :" + link + "\n");
  }
}

principal();

function insere(insert) {
  //if deve ficar no começo do .each, caso contrário apenas o ultimo valor é carregado
  con.query(
    "SELECT * FROM projetos WHERE Codigo = '" + insert[0] + "' LIMIT 1",
    (err, rows, result) => {
      if (err) throw err;
      var resposta = rows;
      if (resposta[0] === undefined) {
        geral.insere_basico(insert, "projetos");
      } else {
        con.query(
          "UPDATE projetos SET Autor = '" +
            insert[1] +
            "', Assunto = '" +
            insert[2] +
            "', Anotacao = '" +
            insert[3] +
            "', LinkDocumento = '" +
            insert[4] +
            "', Ano = '" +
            insert[5] +
            "' WHERE Codigo = '" +
            insert[0] +
            "'"
        );
      }
    }
  );
}
