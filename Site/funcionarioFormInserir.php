<form action="./funcionarioInserir.php" id="formulario-funcionarios" method="POST">

<div id="titulo" class=" bg-primary text-light text-center py-3">
    <h4 class="text-center">Cadastrar Funcionário</h4>
</div>

<div class="col-md-12">
    <hr>  
    <div class="form-group">
        <label>RGF</label>
        <input class="form-control" name="Rgf">
    </div>

    <div class="form-group">
        <label>Nome</label>
        <input class="form-control" name="Nome">
    </div>

    <div class="form-group">
        <label>Cargo</label>
        <input class="form-control" name="Cargo">
    </div>

    <div class="form-group">
        <label>Regime</label>
        <input class="form-control" name="Regime">
    </div>
    <div class="form-group">
        <label class="text-left">Categorias de Remuneração</label>
        <input class="form-control" placeholder="Digite a Quantidade de Categorias" id="reqtde" name="remQtd" onkeyup="add_qtd_remuneracao()"></br>
        <div id="reinput"></div>
    </div>

    <div class="form-group">
        <label>Descontos Obrigatórios</label>
        <input class="form-control" placeholder="Digite a Quantidade de Categorias" id="deqtde" name="desQtd" onkeyup="add_qtd_desconto()"></br>
        <div id="redescontos"></div>
    </div>

    <div class="form-group">
        <label>Outros Descontos</label>
        <input class="form-control" name="OutrosDescontos">
    </div>
    <hr>
    <div id="button-holder" class="my-2">
        <button class="btn btn-primary" id="botao" type="submit">Cadastrar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">Fechar</span>
        </button>
    </div>
    </form>
    <div id="errmsg"></div>
    <div id="okmsg"></div>
</div>