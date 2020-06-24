<form action="./funcionarioCamaraInserir.php" id="formulario-funcionarios" method="POST">

<div id="titulo" class=" bg-primary text-light text-center py-3">
    <h4 class="text-center">Cadastrar Funcionário</h4>
</div>

<div class="col-md-12">
    <hr>  
    <div class="form-group">
        <label>RGF</label>
        <input class="form-control" name="rgf">
    </div>

    <div class="form-group">
        <label>Nome</label>
        <input class="form-control" name="nome">
    </div>

    <div class="form-group">
        <label>Cargo</label>
        <input class="form-control" name="cargo">
    </div>

    <div class="form-group">
        <label>Vencimento Base</label>
        <input class="form-control" name="vencimento_base">
    </div>

    <div class="form-group">
        <label>Outros Vencimentos</label>
        <input class="form-control" name="outros_vencimentos">
    </div>

    <div class="form-group">
        <label>Previdência</label>
        <input class="form-control" name="previdencia">
    </div>

    <div class="form-group">
        <label>Outros Descontos</label>
        <input class="form-control" name="outros_descontos">
    </div>

    <div class="form-group">
        <label>Total Bruto</label>
        <input class="form-control" name="tbruto">
    </div>

    <div class="form-group">
        <label>Total Desconto</label>
        <input class="form-control" name="tdesconto">
    </div>

    <div class="form-group">
        <label>IRRF</label>
        <input class="form-control" name="irrf">
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