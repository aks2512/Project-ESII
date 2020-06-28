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
              <h5 id="modal-title" class="col-md-8" id="exampleModalLabel">Atualizar Funcionario</h5>
              </div>
              <button type="button" class="close col-md-1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>

          <div class="modal-body">
            <form id="funcionarioFormAtualizar" action="./funcionarioAtualizar.php" method="post">
              <div class="row">
                <div class="col-md-12 text-left">
                    <p><span class="bold">Nome:</span><br>
                    '.$funcionario['nome'].'</p>
                </div>
                <div class="col-md-12 text-left">
                    <p><span class="bold">Cargo:</span></p>
                    <input id="cargo" name="cargo" type="text" value="'.$funcionario['cargo'].'">
                </div>
                <div class="col-md-12 text-left">
                    <p><span class="bold">Regime:</span></p>
                    <input id="regime" name="regime" type="text" value="'.$funcionario['regime'].'">
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
                    <p><span class="bold">Total Desconto:</span><br>
                    '.$funcionario['tdesconto'].'</p>
                </div>
                <div class="col-md-12 text-left">
                    <p><span class="bold">Total Liquido:</span><br>
                    '.$funcionario['tliquido'].'</p>
                </div>
              </div>
              <div>
              <div id="detalhes" class="row">
                <div class="col-md-12 text-left">
                <hr>
                  <div class="row">
                    <div class="col-md-9">
                      <p class="bold">Remuneração</p> 
                    </div>
                    <div class="col-md-3">
                      <button name="input-remuneracao" type="button" class="btn btn-primary btn-addRem" onclick="add_remuneracao()">+</button>
                    </div>
                  </div>
                  <hr>
                  <div id="input-remuneracao">';
                  $count_rem = $remuneracoes->readValoresMonetarios($rgf,'remuneracoes');
                  if($count_rem != NULL){
                    foreach ($remuneracoes->readValoresMonetarios($rgf,'remuneracoes') as $remuneracao):
                      echo'
                      <div id="rem_div'.$remuneracao['id_item'].'" class="row mb-3">
                        <div class="col-md-5 text-left">
                          <input id="delete_rem'.$remuneracao['id_item'].'" type="hidden" name="delete_rem[]" value="false">
                          <input type="hidden" name="rem_id_item[]" value="'.$remuneracao['id_item'].'">
                          <input name="nomesR[]" type="text" value="'.$remuneracao['nome'].'">
                        </div>
                        <div class="col-md-5 text-left">
                          <input name="valoresR[]" type="text" value="'.$remuneracao['valor'].'">
                        </div>
                        <div class="col-md-2">
                          <button name="'.$remuneracao['id_item'].'" type="button" class="btn btn-danger btn-rmvRem" onclick="rmv_remuneracao()">-</button>
                        </div>
                      </div>';
                    endforeach;
                  }
                  echo'</div>
                  </div>
                  <div class="col-md-12 text-left">
                    <hr>
                    <div class="row">
                      <div class="col-md-9">
                        <p class="bold">Descontos Obrigatórios</p> 
                      </div>
                      <div class="col-md-3">
                        <button name="input-desconto" type="button" class="btn btn-primary btn-addDes" onclick="add_desconto()">+</button>
                      </div>
                    </div>
                    <hr>
                    <div id="input-desconto">';
                    $count_des = $descontos->readValoresMonetarios($rgf,'descontos');
                    if($count_des != NULL){
                      foreach ($descontos->readValoresMonetarios($rgf,'descontos') as $desconto):
                          echo'
                          <div id="des_div'.$desconto['id_item'].'" class="row mb-3">
                            <div class="col-md-5 text-left">
                              <input id="delete_des'.$desconto['id_item'].'" type="hidden" name="delete_des[]" value="false">
                              <input type="hidden" name="des_id_item[]" value="'.$desconto['id_item'].'">
                              <input name="nomesD[]" type="text" value="'.$desconto['nome'].'">
                            </div>
                            <div class="col-md-5 text-left">
                              <input name="valoresD[]" type="text" value="'.$desconto['valor'].'">
                            </div>
                            <div class="col-md-2">
                              <button name="'.$desconto['id_item'].'" type="button" class="btn btn-danger btn-rmvDes" onclick="rmv_deconto()">-</button>
                            </div>
                          </div>';
                      endforeach;
                    }
                    echo'</div>
                    </div>
                    <div class="col-md-12 text-left">
                      <hr>
                      <p class="bold">Outros Descontos:</p>
                      <hr>
                      <div class="row">
                          <div class="col-md-6 text-left">
                            <p>Outros</p>
                          </div>
                          <div class="col-md-6 text-left">
                            <input id="outros_descontos" name="outros_descontos" type="text" value="'.$funcionario['outros_descontos'].'">
                          </div>
                      </div>
                      <hr>
                      <div class="row justify-content-center align-items-center mt-3">
                        <div class="col-md-6 text-right">
                          <button type="submit" id="btn-atualizar" name="btn-atualizar" class="btn btn-primary" value="'.$funcionario['rgf'].'">Atualizar</button>                      
                        </div>
                        <div class="col-md-6 text-left">
                          <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">Fechar</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>';
      endforeach;
?>  