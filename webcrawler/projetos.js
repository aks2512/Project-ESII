var request = require("request-promise");
var cheerio = require("cheerio");
var mysql = require("mysql2");
const con = require("./con-factory");
const geral = require("./geral");
const {
  insere_basico
} = require("./geral");
var iconv = require("iconv-lite");
const fs = require("fs");

var requisicoes = 0;
var finalizacoes = 0;

principal();

async function principal() {
  var data = new Date();
  var AnoAtual = data.getFullYear(); //Coleta o ano atual
  var items = 0;

  var tipodelei = new Array(
    "leiordinaria",
    "leicomplementar",
    "pelo",
    "decreto legislativo",
    "resolução"
  ); //essa variavel serve para mostrar qual tipo de projeto está sendo gravado
  var tipourl = new Array("plo", "plc", "pelo", "pdl", "pr"); //Esse vetor é responsavel por passar pelos links daonde existe cada ano e páginas dos respectivos projetos
  var projetos = new Array();

  var insert = new Array(0, 0, 0, 0, 0, 0, 0);
  var cont = 0;
  var tipo = 0;
  while (tipo < tipourl.length) {
    var ano = 2005;
    console.log(tipodelei[tipo]);
    while (ano <= AnoAtual) {
      var paginas = 0;
      projetos[cont] = new Array();
      var k = 0;
      await request(
        //Esse request mapeia a quantidade de paginas das tabelas de cada ano
        "http://www.cmmc.com.br/projetos/" +
        tipourl[tipo] +
        ".php?pg=0&textfield_num=&textfield_assunto=&textfield_autor=&ano=" +
        ano,
        async function(err, response, html) {
          var $ = await cheerio.load(html);
          $(".pg").each(function() {
            paginas++;
          });
        }
      );
      var linhas = 0;
      while (k <= paginas) {
        await request.get({
            uri: "http://www.cmmc.com.br/projetos/" +
              tipourl[tipo] +
              ".php?pg=" +
              k +
              "&textfield_num=&textfield_assunto=&textfield_autor=&ano=" +
              ano,
            encoding: null,
          },
          function(err, response, html) {
            if (err) console.log("Erro:" + err);
            html = iconv.decode(html, "ISO-8859-1");
            var $ = cheerio.load(html);
            var link;

            var colunas = 0;

            $('tbody tr[title="Clique para abrir o anexo."] a').each(
              function() {
                insert[colunas] = $(this).text().trim().replace("'", "");
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
                  console.log(insert);
                  linhas++;
                  items++;
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
    while (j <= cont) {
      //quando todos os projetos forem gravados eles serão inseridos no BD
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

function insere(insert) {
  con.query(
    "SELECT * FROM projetos WHERE codigo = '" + insert[1] + "'",
    function(err, rows, result) {
      if (err) throw err;
      var resposta = rows || undefined;
      if (resposta === undefined || resposta[0] == "") {
        geral.insere_basico(insert, "funcionarios_camara");
      } else {
        console.log("Att registro");
        console.log(resposta[0]);
        con.query(
          "UPDATE projetos SET autor = '" +
          insert[2] +
          "', assunto = '" +
          insert[3] +
          "', anotacao = '" +
          insert[4] +
          "', link = '" +
          insert[5] +
          "', ano = '" +
          insert[6] +
          "', modificado = NULL WHERE codigo = '" +
          insert[1] +
          "'",
          function(err, results) {
            if (err) throw err;
          }
        );
      }
    }
  );
}

var seg = 59;
var min = 59;
var hora = 23;
var dia = 6;

con_main.on("acquire", function() {
  requisicoes++;
});
con_main.on("release", function() {
  setTimeout(function() {
    finalizacoes++;
    console.log(finalizacoes + ":" + requisicoes);
    if (finalizacoes == requisicoes) {
      //quando todas as requisições estiverem acabadas



      var int = setInterval(function() {
        console.clear();
        seg--;

        if (seg == -1) {
          seg = 59;
          min--;
        }
        if (min == -1) {
          min = 59;
          hora--;
        }
        if (hora == -1) {
          hora = 23;
          dia--;
        }
        if (dia <= -1) {
          dia = 29;
          principal();
          clearInterval(int);
        }
        console.log(
          "Próxima execução em: " +
          dia +
          " dia(s) " +
          hora +
          "h " +
          min +
          " min " +
          seg +
          " s"
        );
      }, 1);
    }
  }, 10000); //atraso para que o programa conssiga gerar todas as requisicoes
});