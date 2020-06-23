<form action="./projetoInserir.php" id="formulario-projetos" method="POST">

<div id="titulo" class=" bg-primary text-light text-center py-3">
    <h4 class="text-center">Cadastrar Projeto</h4>
</div>

<div class="col-md-12">
    <hr>  
    <div class="form-group">
        <label>Tipo do Projeto</label>
        <input class="form-control" name="tipo_projeto">
    </div>

    <div class="form-group">
        <label>Ano</label>
        <input class="form-control" name="ano">
    </div>

    <div class="form-group">
        <label>Id</label>
        <input class="form-control" name="id">
    </div>

    <div class="form-group">
        <label>Autor</label>
        <input class="form-control" name="autor">
    </div>
    <div class="form-group">
        <label class="text-left">Link</label>
        <input class="form-control" name="link">
    </div>

    <div class="form-group">
        <label>Assunto</label>
        <input class="form-control" name="assunto"></br>
    </div>

    <div class="form-group">
        <label>Anotação</label>
        <input class="form-control" name="anotacao">
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