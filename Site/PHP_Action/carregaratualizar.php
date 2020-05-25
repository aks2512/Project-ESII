<?php
    include "conexao.php";

    $id = $_POST['id'];
    $pos = $_POST['pos'];

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
        <div class="modal-header bg-color">
          <div class="row" >
            <h5 class="modal-title col-md-9" id="exampleModalLabel">'.$row['Nome'].'</h5>  
          </div>
          <button type="button" class="close col-md-1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
        <div class="row">
            <div class="col-md-12 text-left">
            
              <p class="bold">Cargo:<br>
              <input id="Cargo" type="checkbox">'.$row['Cargo'].'</p>
            </div>
            <div class="col-md-12 text-left">
              <p class="bold">Referência:<br>
                '.$row['Modificado'].'</p>
            </div>
            <div class="col-md-12 text-left">
              <p class="bold">Total Bruto:<br>
                '.$row['TBruto'].'</p>
            </div>
            <div class="col-md-12 text-left">
              <p class="bold">Total Liquido:<br>
                '.$row['Tliquido'].'</p>
            </div>
            <div class="col-md-12 text-left">
              <p class="bold">Total de Descontos:<br>
                '.$row['TDescontos'].'</p>
            </div>
          </div>
          <div>
            <div id="detalhes" class="row">
                <div class="col-md-12 text-left">
                    <p>Remuneração</p>
                    <hr>';

        $sql = "SELECT id,id_item,categoria,subcategoria,valor FROM detalhes WHERE '$id' = id and categoria = 'remuneracao' ORDER BY valor DESC ";

        $query =  $conn->query($sql);

        if($query->num_rows>0)
            while($row = $query->fetch_assoc())
            {
                $response = $response.
                
                '
                <div class="row">
                  <div class="col-md-6 text-left">   
                    <p><input id="'.$row['id_item'].'" type="checkbox">'.$row['subcategoria'].'</p>
                  </div>
                  <div class="col-md-6 text-left">
                    <p>'.$row['valor'].'</p>
                  </div>
                </div>';
              
            }

            $response = $response.
            '</div>
            <div class="col-md-12 text-left">
                <p>Descontos Obrigatorios:</p>
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
                  <p><input id="'.$row['id_item'].'" type="checkbox">'.$row['subcategoria'].'</p>
                </div>
                <div class="col-md-6 text-left">
                  <p>'.$row['valor'].'</p>
                </div>
                </div>';
            }
            $response = $response.
            '</div>
            <div class="col-md-12 text-left">
              <p>Outros Descontos:</p>
              <hr>
              <div class="row">
                <div class="col-md-6 text-left">
                  <p><input id="OutrosDescontos" type="checkbox">Outros</p>
                </div>
                <div class="col-md-6 text-left">
                  <p>'.$outrosval.'</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button id="continuar" class="btn btn-warning" value="'.$pos.'">Próximo</button>
        <button id="confirmar" class="btn btn-success"value="'.$pos.'">Confirmar</button>';
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
                
             