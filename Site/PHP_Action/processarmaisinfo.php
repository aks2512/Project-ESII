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
        $response = '<div><tr><td>'.$row['Nome'].'</td></tr>'.
                    '<tr><td>'.$row['TotalDescontos'].
        
        
        
        
                                          '</div>';
    }
}
else
{
    echo "Houve um erro, por favor tente novamente mais tarde...";
}

?>
