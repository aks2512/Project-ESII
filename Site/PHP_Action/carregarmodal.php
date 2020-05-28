<?php
//é responsavel por carregar o modal do funcionario selecionado

    include "conexao.php";

    $id = $_POST['id'];

    $sql = "SELECT Nome,Cargo,Modificado,TBruto,Tliquido,TDescontos,OutrosDescontos FROM funcionarios_bd WHERE '$id' = id";

    $query =  $conn->query($sql);

    if(!$query){//Detecta erro da query
        trigger_error('Invalid query'.$conn->error);
    }
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()) 
        {
            $outrosval = $row['OutrosDescontos'];
           
            $response = 
            
          ' 
        <div id="bg-modal" class="modal-header">
          <div class="row align-items-center" >
            <img src="./Imagens/usuario.png" class="col-md-4" >
            <h5 id="modal-title" class="col-md-8" id="exampleModalLabel">'.$row['Nome'].'</h5>  
          </div>
          <button type="button" class="close col-md-1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
        <div class="row">
            <div class="col-md-12 text-left">
              <p><span class="bold">Cargo:</span><br>
               '.$row['Cargo'].'</p>
            </div>
            <div class="col-md-12 text-left">
            <p><span class="bold">Referência:</span><br>
                '.$row['Modificado'].'</p>
            </div>
            <div class="col-md-12 text-left">
            <p><span class="bold">Total Bruto:</span><br>
                '.$row['TBruto'].'</p>
            </div>
            <div class="col-md-12 text-left">
            <p><span class="bold">Total Liquido:</span><br>
                '.$row['Tliquido'].'</p>
            </div>
            <div class="col-md-12 text-left">
            <p><span class="bold">Total Descontos:</span><br>
                '.$row['TDescontos'].'</p>
            </div>
          </div>
          <div>
            <div id="detalhes" class="row">
                <div class="col-md-12 text-left">
                    <p class="bold">Remuneração</p>
                    <hr>';

        $sql = "SELECT id,categoria,subcategoria,valor FROM detalhes WHERE '$id' = id and categoria = 'remuneracao' ORDER BY valor DESC ";

        $query =  $conn->query($sql);

        if($query->num_rows>0)
            while($row = $query->fetch_assoc())
            {
                $response = $response.
                
                '
                <div class="row">
                  <div class="col-md-6 text-left">
                    <p>'.$row['subcategoria'].'</p>
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

        $sql = "SELECT * FROM detalhes WHERE '$id' = id and categoria = 'desconto' ORDER BY valor DESC ";

        $query =  $conn->query($sql);

        if($query->num_rows)
        {
            while($row = $query->fetch_assoc())
            {
                $response = $response.
                '<div class="row">
                <div class="col-md-6 text-left">
                  <p>'.$row['subcategoria'].'</p>
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
                
             