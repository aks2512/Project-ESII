$(document).ready(function(){
    $('#busca').keyup(function(){
        escrevertabela();
    })
    $('#filtro').change(function(){
        escrevertabela();
    })
    $('#qtdeLinhas').change(function(){
        escrevertabela();
    })
    $('#')
});

function escrevertabela() {
    var filtro=document.getElementById('filtro').value;
    var linhas=document.getElementById('controlalinhas').value;
    var busca=document.getElementById('busca').value;
    $.ajax({
        type: "POST",
        url: "PHP_Action/processartabela.php",
        data: {'filtro': filtro,'linhas': linhas,'busca': busca},
        success: function(dados) {
            document.getElementById('conteudo-tabela').innerHTML=dados;
        }
    })
}