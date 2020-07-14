function manual_func_att() {
    console.log("ok");
    axios.get("http://localhost:3000/API/carregar_funcionarios_geral").then(response => alert(response.data)).catch(erro => alert(erro))
} //atualização manual dos funcionários

function acionar_webcrawler() {
    console.log("ok");
    axios.get("http://localhost:9000/API/ligar_webcrawler").then(response => alert(response.data)).catch(erro => alert(erro))
} //atualização manual dos funcionários

function manual_projeto_att() {
    axios.get("http://localhost:3000/API/carregar_projetos").then(response => alert(response.data)).catch(erro => alert(erro))
} //atualização manual dos funcionários

function json_prefeitura() {
    console.log("ok");
    $.ajax({
        url: "http://localhost:3000/API/selecionar_funcionarios_prefeitura",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        method: "get",
    });
} //atualização manual dos funcionários

function json_camara() {
    console.log("ok");
    $.ajax({
        url: "http://localhost:3000/API/selecionar_funcionarios_camara",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        method: "get",
    });
} //atualização manual dos funcionários

function json_projetos() {
    console.log("ok");
    $.ajax({
        url: "http://localhost:3000/API/selecionar_projetos",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        method: "get",
    });
} //atualização manual dos funcionários