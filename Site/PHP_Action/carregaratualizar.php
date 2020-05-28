<?php
//carrega o modal de editar o funcionario na parte do administrador

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
            <div class="col-md-10 text-left">
              <p class="bold">Cargo:<br>
              <div id="Cargo">'.$row['Cargo'].'<div class="col-md-2 text-left">
              </div></div></p>
            </div>
            <div class="col-md-2 text-left">
            <button value="Cargo" id="editCargo" class="btn btn-primary"><i class="fas fa-edit"></i></button>
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
                    <p><button onclick="addItemRemuneracao()" value="0" class="btn btn-success remuneracao">+</button>Remuneração:</p>
                    <hr>
                    <div id="additems-remuneracao"></div>';

        $sql = "SELECT id,id_item,categoria,subcategoria,valor FROM detalhes WHERE '$id' = id and categoria = 'remuneracao' ORDER BY valor DESC ";

        $query =  $conn->query($sql);

        if($query->num_rows>0)
            while($row = $query->fetch_assoc())
            {
                $response = $response.
                
                '
                <div class="row">
                  <div class="col-md-4 text-left">   
                    <p>'.$row['subcategoria'].'</p>
                  </div>
                  <div class="col-md-5 text-left" id="'.$row['id_item'].'">'.$row['valor'].'
                  </div>
                  <div class="col-md-3 text-left '.$row['id_item'].'">
                    <button id="editDetalhe" value="'.$row['id_item'].'" class="btn btn-primary"><i class="fas fa-edit"></i></button>
                    <button id="rmDetalhe" value="'.$row['id_item'].'" class="btn btn-danger"><i class="fas fa-minus-square"></i></button>
                  </div>
                </div>';
              
            }

            $response = $response.
            '</div>
            <div class="col-md-12 text-left">
                <p><button onclick="addItemDescontos()" value="0" class="btn btn-success">+</button>Descontos Obrigatorios:</p>
                <hr">
                <div id="items-descontos"></div>';
        }

        $sql = "SELECT * FROM detalhes WHERE '$id' = id and categoria = 'desconto' ORDER BY valor DESC ";

        $query =  $conn->query($sql);

        if($query->num_rows)
        {
            while($row = $query->fetch_assoc())
            {
                $response = $response.
                '<div class="row">
                <div class="col-md-4 text-left">
                  <p>'.$row['subcategoria'].'</p>
                </div>
                <div class="col-md-5 text-left" id="'.$row['id_item'].'">'.$row['valor'].'
                </div>
                <div class="col-md-3 text-left '.$row['id_item'].'">
                    <button id="editDetalhe" value="'.$row['id_item'].'" class="btn btn-primary"><i class="fas fa-edit"></i></button>
                    <button id="rmDetalhe" value="'.$row['id_item'].'" class="btn btn-danger"><i class="fas fa-minus-square"></i></button>
                </div>
                </div>';
            }
            $response = $response.
            '</div>
            <div class="col-md-12 text-left">
              <p>Outros Descontos:</p>
              <hr>
              <div class="row">
                <div class="col-md-4 text-left">
                  <p><div class="OutrosDescontos">Outros</div></p>
                </div>
                <div class="col-md-5 text-left" id="outrosval">
                  <p>'.$outrosval.'</p>
                </div>
                <div class="col-md-3 text-left">
                <button value="outrosval" id="editDetalhe" class="btn btn-primary"><i class="fas fa-edit"></i></button>
                <button id="rmDetalhe" value="outrosval" class="btn btn-danger"><i class="fas fa-minus-square"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="memoriaedicao"></div>
        <button id="continuar" class="btn btn-primary" value="'.$pos.'">Próximo</button>
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
                
             