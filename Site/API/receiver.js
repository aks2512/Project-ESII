function manual_func_att() {
    alert("Comando Recebido!");
    axios.get("http://localhost:3000/API/carregar_funcionarios_geral").then(response => alert(response.data)).catch(erro => alert(erro))
} //atualização manual dos funcionários

function acionar_webcrawler() {
    alert("Comando Recebido!");
    axios.get("http://localhost:9000/API/ligar_webcrawler").then(response => alert(response.data)).catch(erro => alert(erro))
} //atualização manual dos funcionários

function manual_projeto_att() {
    alert("Comando Recebido!");
    axios.get("http://localhost:3000/API/carregar_projetos").then(response => alert(response.data)).catch(erro => alert(erro))
} //atualização manual dos funcionários

function json_prefeitura() {
    console.log("ok");
    axios.get("http://localhost:3000/API/selecionar_funcionarios_prefeitura").then(response => alert(response.data)).catch(erro => alert(erro))
} //atualização manual dos funcionários

function json_camara() {
    console.log("ok");
    axios.get("http://localhost:3000/API/selecionar_funcionarios_camara").then(response => alert(response.data)).catch(erro => alert(erro))
} //atualização manual dos funcionários

function json_projetos() {
    console.log("ok");
    axios.get("http://localhost:3000/API/selecionar_projetos").then(response => alert(response.data)).catch(erro => alert(erro))
} //atualização manual dos funcionários