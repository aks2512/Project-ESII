<?php

  require_once 'vendor/autoload.php';

  $rgf = $_POST['id'];

  $funcionarioDao = new \App\Model\FuncionarioCamaraDao();
  $funcionarioDao->readRgf($rgf);

  foreach($funcionarioDao->readRgf($rgf) as $funcionario):
    echo '
    <div id="bg-modal" class="modal-header">
      <div class="row align-items-center">
        <img src="./Imagens/usuario.png" class="col-md-4">
        <h5 id="modal-title" class="col-md-8" id="exampleModalLabel">Atualizar Funcionario</h5>
      </div>
      <button type="button" class="close col-md-1" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <div class="modal-body">
      <form id="funcionarioFormAtualizar" action="./funcionarioCamaraAtualizar.php" method="post">
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
              <p><span class="bold">Referência:</span><br>
              '.$funcionario['modificado'].'</p>
          </div>
          <div class="col-md-12 text-left">
              <p><span class="bold">Previdência:</span></p>
              <input id="previdencia" name="previdencia" type="text" value="'.$funcionario['previdencia'].'">
          </div>
          <div class="col-md-12 text-left">
              <p><span class="bold">Vencimento Base:</span></p>
              <input id="vencimento_base" name="vencimento_base" type="text" value="'.$funcionario['vencimento_base'].'">
          </div>
          <div class="col-md-12 text-left">
              <p><span class="bold">Outros Vencimentos:</span></p>
              <input id="outros_vencimentos" name="outros_vencimentos" type="text" value="'.$funcionario['outros_vencimentos'].'">
          </div>
          <div class="col-md-12 text-left">
              <p><span class="bold">Total Bruto:</span></p>
              <input id="tbruto" name="tbruto" type="text" value="'.$funcionario['tbruto'].'">
          </div>
          <div class="col-md-12 text-left">
              <p><span class="bold">Total Desconto:</span></p>
              <input id="tdesconto" name="tdesconto" type="text" value="'.$funcionario['tdesconto'].'">
          </div>
          <div class="col-md-12 text-left">
              <p><span class="bold">Total Liquido:</span><br>
              '.$funcionario['tliquido'].'</p>
          </div>
          <div class="col-md-12 text-left">
              <p><span class="bold">Outros Descontos:</span></p>
              <input id="outros_descontos" name="outros_descontos" type="text" value="'.$funcionario['outros_descontos'].'">
          </div>
          <div class="col-md-12 text-left">
              <p><span class="bold">IRRF:</span></p>
              <input id="irrf" name="irrf" type="text" value="'.$funcionario['irrf'].'">
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
      </form>
    </div>';
  endforeach;
?>  