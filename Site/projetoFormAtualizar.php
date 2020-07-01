<?php

  require_once 'vendor/autoload.php';

  $id = $_POST['id'];

  $projetoDao = new \App\Model\ProjetoDao();
  $projetoDao->readId($id);

  foreach($projetoDao->readId($id) as $projeto):
    echo '<div id="bg-modal" class="modal-header">
            <div class="col-md-12">
              <h5 id="modal-title" id="exampleModalLabel">Atualizar Projeto</h5>
            </div>
          </div>

          <div class="modal-body row justify-content-center align-items-center">
            <form id="projetoFormAtualizar" action="./projetoAtualizar.php" method="post">
              <div class="row">
                <div class="col-md-12">
                    <p><span class="bold">Id:</span><br>
                    '.$projeto['codigo'].'</p>
                </div>
                <div class="col-md-12">
                  <p><span class="bold">Tipo Projeto:</span></p>
                  <input class="col-md-10 text-center" id="tipo_projeto" name="tipo_projeto" type="text" value="'.$projeto['tipo_projeto'].'">
                </div>
                <div class="col-md-12">
                  <p><span class="bold">Ano:</span></p>
                  <input class="col-md-10 text-center" id="ano" name="ano" type="text" value="'.$projeto['ano'].'">
                </div>
                <div class="col-md-12">
                  <p><span class="bold">Autor:</span></p>
                  <input class="col-md-10 text-center" id="autor" name="autor" type="text" value="'.$projeto['autor'].'">
                </div>
                <div class="col-md-12">
                  <p><span class="bold">Link:</span></p>
                  <input class="col-md-10 text-center" id="link" name="link" type="text" value="'.$projeto['link'].'">
                </div>
                <div class="col-md-12">
                  <p><span class="bold">Assunto:</span></p>
                  <input class="col-md-10 text-center" id="assunto" name="assunto" type="text" value="'.$projeto['assunto'].'">
                </div>
                <div class="col-md-12">
                  <p><span class="bold">Anotação:</span></p>
                  <input class="col-md-10 text-center" id="anotacao" name="anotacao" type="text" value="'.$projeto['anotacao'].'">
                </div>
                    <hr class="col-md-12">
                <div class="col-md-6 text-right my-3">
                  <button type="submit" id="btn-atualizar" name="btn-atualizar" class="btn btn-primary" value="'.$projeto['codigo'].'">Atualizar</button>                      
                </div>
                <div class="col-md-6 text-left my-3">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">Fechar</span>
                  </button>
                </div>
            </form>
          </div>';
      endforeach;
?>  