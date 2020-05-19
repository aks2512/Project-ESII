<?php
    class Funcionario{
        private $Nome;
        private $Cargo;
        private $Modificado;
        private $Tbruto;
        private $Tliquido;
        private $TDescontos;
        private $DescontosObr;
        private $OutrosDescontos;
        private $id;
        private $VD;
        private $TD;

        private function inserir_funcionario($i,$j){//VD - Valor dos detalhes; TD - tipo dos detalhes ; Coluna 0 são detalhes da remuneração ; Coluna 1 são dos descontos obrigatórios
            include "conexao.php";

            for($cont=$i;$cont>=0;$cont++)//Soma os valores relacionados a remuneração total
            {
                $VD[$i][0] = floatval(str_replace(',','.',$VD[$i][0]));
                $Tbruto += $VD[$j][0] ;
            }
            for($cont=$i;$cont>=0;$cont++)//Soma os valores relacionados ao desconto obrigatório total
            {
                $VD[$j][1] = floatval(str_replace(',','.',$VD[$j][1]));
                $DescontosObr += $VD[$j][1] ;
            }

            $TDescontos = $DescontosObr + $OutrosDescontos;

            $sql = "INSERT INTO funcionarios_BD ".
            "VALUES ('NULL' , '$Nome', '$Cargo', '$Modificado', '$Regime', '$Tbruto', '$Tliquido', '$TDescontos', '$DescontosObr' , '$OutrosDescontos')";

            if (mysqli_query($conn, $sql)) {
            } else {
                echo utf8_encode("Erro: " . $sql . "<br>" . mysqli_error($conn));
                return;
            }

            Funcionario::ultimo_id();//vai definir o atributo id com o maior valor id dentro do banco de dados

            while($i>=0)//Carrega as remunerações
            {
                $sql = "INSERT INTO detalhes VALUES ('$id','Remuneracao','$VD[$i]['0']','$TD[$i]['0']')";
                $i--;
            }

            while($j>=0)//Carrega os descontos
            {
                $sql = "INSERT INTO detalhes VALUES ('$id','Remuneracao','$VD[$j]['1']','$TD[$j]['1']')";
                $j--;
            }

            
            return '<div class="alert alert-success">Funcionário Inserido com sucesso!</div>';
        }

        private function deletar_funcionario($id){//Deleta todas as informações do funcionario
            include "conexao.php";
            
            $sql = "DELETE * FROM detalhes WHERE '$id' = id";

            if (mysqli_query($conn, $sql)) {
            } else {
                echo utf8_encode("Erro: " . $sql . "<br>" . mysqli_error($conn));
                return;
            }

            $sql = "DELETE * FROM funcionarios_BD WHERE '$id' = id";

            if (mysqli_query($conn, $sql)) {
            } else {
                echo utf8_encode("Erro: " . $sql . "<br>" . mysqli_error($conn));
                return;
            }

            return '<div class="alert alert-success">Funcionário Deletado com sucesso!</div>';
        }

        private function atualizar_funcionario($del,$att){//$del guarda os id's dos itens a serem deletados e $att dos itens a serem atualizados
            //Salva informação anterior na tabela histórico da repectiva tabela de principal (detalhes/funcionario_bd)
            //Chama função de inserção mantendo valores não modificados e substituindo novos pelo atributo da classe
            //Atualiza Detalhes Selecionados
            //Deleta Detalhes selecionados
        }

        private function ultimo_id(){
            include "conexao.php";

            $sql = "SELECT MAX(id) as id FROM tabela";
            $query = $conn->query($sql);
            $row = $query->fetch_assoc();

            $id = $row['id'];
        }
    }
?>