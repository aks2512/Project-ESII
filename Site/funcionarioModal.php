<?php

  require_once 'vendor/autoload.php';

  $rgf = $_POST['id'];

  $funcionarioDao = new \App\Model\FuncionarioDao();
  $remuneracoes = new \App\Model\FuncionarioDao();
  $descontos = new \App\Model\FuncionarioDao();
  $funcionarioDao->readRgf($rgf);

  foreach($funcionarioDao->readRgf($rgf) as $funcionario):
    echo '<div id="bg-modal" class="modal-header">
              <div class="row align-items-center">
              <img src="./Imagens/usuario.png" class="col-md-4">
              <h5 id="modal-title" class="col-md-8" id="exampleModalLabel">'.$funcionario['nome'].'</h5>
              </div>
              <button type="button" class="close col-md-1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>

          <div class="modal-body">
              <div class="row">
              <div class="col-md-12 text-left">
                  <p><span class="bold">Cargo:</span><br>
                  '.$funcionario['cargo'].'</p>
              </div>
              <div class="col-md-12 text-left">
                  <p><span class="bold">Referência:</span><br>
                  '.$funcionario['modificado'].'</p>
              </div>
              <div class="col-md-12 text-left">
                  <p><span class="bold">Total Bruto:</span><br>
                  '.$funcionario['tbruto'].'</p>
              </div>
              <div class="col-md-12 text-left">
                  <p><span class="bold">Total Liquido:</span><br>
                  '.$funcionario['tliquido'].'</p>
              </div>
              <div class="col-md-12 text-left">
                  <p><span class="bold">Total Descontos:</span><br>
                  '.$funcionario['tdesconto'].'</p>
              </div>
              </div>
              <div>
              <div id="detalhes" class="row">
                  <div class="col-md-12 text-left">
                  <p class="bold">Remuneração</p>
                  <hr>
                  <div class="row">';
                  $remuneracoes->readValoresMonetarios($rgf,'remuneracoes');
                  foreach ($remuneracoes->readValoresMonetarios($rgf,'remuneracoes') as $remuneracao):
                      echo'<div class="col-md-6 text-left">
                      <p>'.$remuneracao['nome'].'</p>
                      </div>
                      <div class="col-md-6 text-left">
                      <p>'.$remuneracao['valor'].'</p>
                      </div>';
                  endforeach;
                  echo'</div>
                  </div>
                  <div class="col-md-12 text-left">
                  <p class="bold">Descontos Obrigatorios:</p>
                  <hr>
                  <div class="row">';
                  $descontos->readValoresMonetarios($rgf,'descontos');
                  foreach ($descontos->readValoresMonetarios($rgf,'descontos') as $desconto):
                      echo'<div class="col-md-6 text-left">
                      <p>'.$desconto['nome'].'</p>
                      </div>
                      <div class="col-md-6 text-left">
                      <p>'.$desconto['valor'].'</p>
                      </div>';
                  endforeach;
                  echo'</div>
                  </div>
                  <div class="col-md-12 text-left">
                  <p class="bold">Outros Descontos:</p>
                  <hr>
                  <div class="row">
                      <div class="col-md-6 text-left">
                      <p>Outros</p>
                      </div>
                      <div class="col-md-6 text-left">
                      <p>'.$funcionario['outros_descontos'].'</p>
                      </div>
                  </div>
                  </div>
              </div>
            </div>';
    endforeach;
?>  