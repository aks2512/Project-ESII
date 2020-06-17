<?php
   $id_recebido = $_POST['busca'];
   include("conexao.php");

   $sql = "SELECT * FROM funcionarios WHERE id = '$id_recebido'";

   $query = $conn->query($sql);

   if(!$query)
   {
       echo "não foi possível carregar pedido...";
       exit;
   }    

  

   if($query->num_rows > 0){

        $row = $query->fetch_assoc();

        $principal = array(
        'nome'=>$row['Nome'],
        'cargo'=>$row['Cargo'],
        'remuneracao'=>$row['Remuneracao'],
        'modificado'=>$row['Modificado'],
        'regime'=>$row['Regime'],
        'tbruto'=>$row['TBruto'],
        'tliquido'=>$row['Tliquido'],
        'tdescontos'=>$row['TDescontos'],
        'descontosobgr'=>$row['DescontosObgr'],
        'outrosdescontos'=>$row['OutrosDescontos'],
        );

        echo json_encode($principal);

        $id = $row['id'];

    

        $sql = "SELECT * FROM detalhes WHERE id = '$id'";

        $query = $conn->query($sql);

        if(!$query)
        {
            echo "não foi possível carregar pedido...";
            exit;
        }    
        if($query->num_rows>0)
        {
            while($row = $query->fetch_assoc()) {
                $detalhes = array(
                    'categoria' => $row['Categoria'],
                    'subcategoria' => $row['Subcategoria'],
                    'valor' => $row['Valor'],
                );

                echo json_encode($detalhes);//retorno
            }
        }
    }
else
{
    echo "Houve um erro, por favor tente novamente mais tarde...";
}

?>
