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
              <h5 id="modal-title" class="col-md-8" id="exampleModalLabel">'.$funcionario['nome'].'</h5>
            </div>
            <button type="button" class="close col-md-1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
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
                    <p><span class="bold">Previdência:</span></br>
                    '.$funcionario['previdencia'].'</p>
                </div>
                <div class="col-md-12 text-left">
                    <p><span class="bold">Vencimento Base:</span><br>
                    '.$funcionario['vencimento_base'].'</p>
                </div>
                <div class="col-md-12 text-left">
                    <p><span class="bold">Outros Vencimentos:</span><br>
                    '.$funcionario['outros_vencimentos'].'</p>
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
                <div class="col-md-12 text-left">
                    <p><span class="bold">Outros Descontos:</span><br>
                    '.$funcionario['outros_descontos'].'</p>
                </div>
                <div class="col-md-12 text-left">
                    <p><span class="bold">IRRF:</span><br>
                    '.$funcionario['irrf'].'</p>
                </div>
            </div>
        </div>';
    endforeach;
?>  