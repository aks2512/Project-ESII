<?php
//é responsavel por carregar o modal do funcionario selecionado

    include "conexao.php";

    $id = $_POST['id'];

    $sql = "SELECT nome,cargo,modificado,tbruto,tliquido,tdesconto,outros_descontos FROM funcionarios WHERE '$id' = id";

    $query =  $conn->query($sql);

    if(!$query){//Detecta erro da query
        trigger_error('Invalid query'.$conn->error);
    }
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()) 
        {
            $outrosval = $row['outros_descontos'];
           
            $response = 
            
          ' 
        <div id="bg-modal" class="modal-header">
          <div class="row align-items-center" >
            <img src="./Imagens/usuario.png" class="col-md-4" >
            <h5 id="modal-title" class="col-md-8" id="exampleModalLabel">'.$row['nome'].'</h5>  
          </div>
          <button type="button" class="close col-md-1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
        <div class="row">
            <div class="col-md-12 text-left">
              <p><span class="bold">Cargo:</span><br>
               '.$row['cargo'].'</p>
            </div>
            <div class="col-md-12 text-left">
            <p><span class="bold">Referência:</span><br>
                '.$row['modificado'].'</p>
            </div>
            <div class="col-md-12 text-left">
            <p><span class="bold">Total Bruto:</span><br>
                '.$row['tbruto'].'</p>
            </div>
            <div class="col-md-12 text-left">
            <p><span class="bold">Total Liquido:</span><br>
                '.$row['tliquido'].'</p>
            </div>
            <div class="col-md-12 text-left">
            <p><span class="bold">Total Descontos:</span><br>
                '.$row['tdesconto'].'</p>
            </div>
          </div>
          <div>
            <div id="detalhes" class="row">
                <div class="col-md-12 text-left">
                    <p class="bold">Remuneração</p>
                    <hr>';

        $sql = "SELECT id,nome,valor FROM remuneracoes WHERE '$id' = id ORDER BY valor DESC ";

        $query =  $conn->query($sql);

        if($query->num_rows>0)
            while($row = $query->fetch_assoc())
            {
                $response = $response.
                
                '
                <div class="row">
                  <div class="col-md-6 text-left">
                    <p>'.$row['nome'].'</p>
                  </div>
                  <div class="col-md-6 text-left">
                    <p>'.$row['valor'].'</p>
                  </div>
                </div>';
              
            }

            $response = $response.
            '</div>
            <div class="col-md-12 text-left">
                <p class="bold">Descontos Obrigatorios:</p>
                <hr>';
        }

        $sql = "SELECT * FROM descontos WHERE '$id' = id ORDER BY valor DESC ";

        $query =  $conn->query($sql);

        if($query->num_rows)
        {
            while($row = $query->fetch_assoc())
            {
                $response = $response.
                '<div class="row">
                <div class="col-md-6 text-left">
                  <p>'.$row['nome'].'</p>
                </div>
                <div class="col-md-6 text-left">
                  <p>'.$row['valor'].'</p>
                </div>
                </div>';
            }
            $response = $response.
            '</div>
            <div class="col-md-12 text-left">
              <p class="bold">Outros Descontos:</p>
              <hr>
              <div class="row">
                <div class="col-md-6 text-left">
                  <p>Outros</p>
                </div>
                <div class="col-md-6 text-left">
                  <p>'.$outrosval.'</p>
                </div>
              </div>
            </div>
          </div>
        </div>';
        }
        else
        {
            echo "Erro ao carregar dados...";
        }

        echo $response;
        
    }
    else
    {
        echo "Erro ao carregar dados...";
    }
?>
                
             