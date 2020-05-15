<?php
   $id_recebido = $_POST['busca'];
   //conexão com banco de dados
   $conn = new mysqli("localhost", "root", "", "transparenciamc");
   if( $conn ->connect_error) {
    exit('Erro na conexao');
    }

   $sql = "SELECT * FROM funcionarios_bd WHERE id = '$id_recebido'";

   $query = $conn->query($sql);

   if(!$query)
   {
       echo "não foi possível carregar pedido...";
       exit;
   }    

   if($query->num_rows > 0){
    while($row = $query->fetch_assoc()) {
        $response ='
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-color">
              <div class="row justify-content-end">
                <img src="Imagens/usuario.png" alt="" class="col-md-2">
                <h5 class="modal-title col-md-9" id="exampleModalLabel">Jefferson Akira Fukamizu</h5>
                <button type="button" class="close col-md-1" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </div>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12 text-left">
                  <p class="bold">Cargo:<br>
                    Aux Administrativo</p>
                </div>
                <div class="col-md-12 text-left">
                  <p class="bold">Referência:<br>
                    Fev/2020</p>
                </div>
                <div class="col-md-12 text-left">
                  <p class="bold">Total Bruto:<br>
                    1418,99</p>
                </div>
                <div class="col-md-12 text-left">
                  <p class="bold">Total Liquido:<br>
                    1418,99</p>
                </div>
                <div class="col-md-12 text-left">
                  <p class="bold">Total de Descontos:<br>
                    0</p>
                </div>
              </div>
              <div>
                <div class="row">
                  <div class="col-md-12 text-left">
                    <p>Remuneração</p>
                    <hr>
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <p>VENCIMENTO</p>
                      </div>
                      <div class="col-md-6 text-left">
                        <p>1642,97</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 text-left">
                    <p>Descontos Obrigatorios:</p>
                    <hr>
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <p>IPREM</p>
                      </div>
                      <div class="col-md-6 text-left">
                        <p>180,73</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 text-left">
                    <p>Outros Descontos:</p>
                    <hr>
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <p>Outros</p>
                      </div>
                      <div class="col-md-6 text-left">
                        <p>248,07</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>';
        echo $response;//retorno
    }
}
else
{
    echo "Houve um erro, por favor tente novamente mais tarde...";
}
