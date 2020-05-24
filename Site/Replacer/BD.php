<form action="PHP_Action/inserirfuncionario.php" id="formulario-funcionarios" class="col-md-12" method="POST">

<div id="titulo">
    CADASTRAR FUNCIONÁRIOS NO SISTEMA
</div>

<div class="form-group">
    <label>Nome</label>
    <input id="inputbox" class="form-control" name="Nome">
</div>

<div class="form-group">
    <label>Cargo</label>
    <input id="inputbox" class="form-control" name="Cargo">
</div>

<div class="form-group">
    <label>Data/Referência</label>
    <input id="inputbox" class="form-control" name="ModificadoEm">
</div>

<div class="form-group">
    <label>Regime</label>
    <input id="inputbox" class="form-control" name="Regime">
</div>
<div class="form-group">
    <label>Categorias de Remuneração</label>
    <input class="form-control" placeholder="Digite Quantas categorias são" id="reqtde"></br>
    <div id="reinput"></div>
</div>

<div class="form-group">
    <label>Descontos Obrigatórios</label>
    <input class="form-control" placeholder="Digite Quantas categorias são" id="deqtde"></br>
    <div id="redescontos"></div>
</div>

<div class="form-group">
    <label>Outros Descontos</label>
    <input id="inputbox" class="form-control" name="OutrosDescontos">
</div>

<div id="button-holder">
    <button class="btn btn-primary" id="botao" type="submit">Atualizar</button>
</div>
</form>
<div id="errmsg"></div>
<div id="okmsg"></div>