function manual_func_att() {
    console.log("ok");
    $.ajax({
        url: "http://localhost:3000/API/carregar_funcionarios_geral",
        method: "get",
    })
} //atualização manual dos funcionários

function manual_projeto_att() {
    console.log("ok");
    $.ajax({
        url: "http://localhost:3000/API/carregar_projetos",
        method: "get",
    })
} //atualização manual dos funcionários

function json_prefeitura() {
    console.log("ok");
    $.ajax({
        url: "http://localhost:3000/API/selecionar_funcionarios_prefeitura",
        method: "get",
    })
} //atualização manual dos funcionários

function json_camara() {
    console.log("ok");
    $.ajax({
        url: "http://localhost:3000/API/selecionar_funcionarios_camara",
        method: "get",
    })
} //atualização manual dos funcionários

function json_projetos() {
    console.log("ok");
    $.ajax({
        url: "http://localhost:3000/API/selecionar_projetos",
        method: "get",
    })
} //atualização manual dos funcionários