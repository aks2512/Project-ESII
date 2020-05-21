<?php
    class Funcionario{
        private $Nome;
        private $Cargo;
        private $Regime;
        private $Modificado;
        private $Tbruto;
        private $Tliquido;
        private $TDescontos;
        private $DescontosObr;
        private $OutrosDescontos;
        private $id;
        private $VR;
        private $VD;
        private $TR;
        private $TD;

        public function __construct($VR,$VD,$TR,$TD,$Nome,$Cargo,$Modificado,$OutrosDescontos,$Regime)
        {
            $this->VR=$VR;//Valor Remuneracao/Desconto
            $this->VD=$VD;
            $this->TR=$TR;//Tipo Remuneracao/Desconto
            $this->TD=$TD;
            $this->Nome=$Nome;
            $this->Cargo=$Cargo;
            $this->Modificado=$Modificado;
            $this->OutrosDescontos=$OutrosDescontos;
            $this->Regime=$Regime;
        }

        public function inserir_funcionario($i,$j){//VD - Valor dos detalhes; TD - tipo dos detalhes ; Coluna 0 são detalhes da remuneração ; Coluna 1 são dos descontos obrigatórios
            include "conexao.php";

            for($cont=$i;$cont>=0;$cont--)//Soma os valores relacionados a remuneração total
            {
                $this->VR[$cont] = floatval(str_replace(',','.',$this->VR[$cont]));
                $this->Tbruto = $this->Tbruto + $this->VR[$cont] ;
            }
            for($cont=$i;$cont>=0;$cont--)//Soma os valores relacionados ao desconto obrigatório total
            {
                $this->VD[$cont] = floatval(str_replace(',','.',$this->VD[$cont]));
                $this->DescontosObr =  $this->DescontosObr + $this->VD[$cont];
            }

            $this->TDescontos = $this->DescontosObr + $this->OutrosDescontos;//Calculo dos totais indiretos
            $this->Tliquido = $this->Tbruto - $this->TDescontos;

            $sql = "INSERT INTO funcionarios_BD ".
            "VALUES ('NULL' , '$this->Nome', '$this->Cargo', '$this->Modificado', '$this->Regime', '$this->Tbruto', '$this->Tliquido', '$this->TDescontos', '$this->DescontosObr' , '$this->OutrosDescontos')";

            if (mysqli_query($conn, $sql)) {
            } else {
                echo utf8_encode("Erro: " . $sql . "<br>" . mysqli_error($conn));
                return;
            }

            Funcionario::ultimo_id();//vai definir o atributo id com o maior valor id dentro do banco de dados

            while($i>=0)//Carrega as remunerações
            {
                $val = $this->VR[$i];
                $tipo= $this->TR[$i];

                $sql = "INSERT INTO detalhes VALUES ('$this->id','NULL','Remuneracao','$tipo','$val')";
                
                if(!$sql){
                    return '<div class="alert alert-danger">Erro na requisição!</div>';
                }

                if(mysqli_query($conn,$sql)){
                }else{
                    return '<div class="alert alert-danger">Erro:' . $sql .'<br>'. mysqli_error($conn).'</div>';
                }
                $i--;
            }//endwhile

            while($j>=0)//Carrega os descontos
            {
                $val = $this->VD[$j];
                $tipo= $this->TD[$j];

                $sql = "INSERT INTO detalhes VALUES ('$this->id','NULL','Desconto','$tipo','$val')";

                if(!$sql){
                    return '<div class="alert alert-danger">Erro na requisição!</div>';
                }

                if(mysqli_query($conn,$sql)){
                }else{
                    return '<div class="alert alert-danger">Erro:' . $sql .'<br>'. mysqli_error($conn).'</div>';
                }
                $j--;
            }//endwhile

            mysqli_close($conn);
            
            return '<div class="alert alert-success">Funcionário Inserido com sucesso!</div>';
        }

        private function deletar_funcionario($id){//Deleta todas as informações do funcionario
            include "conexao.php";
            
            $sql = "DELETE * FROM detalhes WHERE '$this->id' = id";

            if (mysqli_query($conn, $sql)) {
            } else {
                echo utf8_encode("Erro: " . $sql . "<br>" . mysqli_error($conn));
                return;
            }

            $sql = "DELETE * FROM funcionarios_BD WHERE '$this->id' = id";

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

            $sql ="SELECT MAX(id) as id FROM funcionarios_bd";
            $query = mysqli_query($conn,$sql);
            $row =mysqli_fetch_array($query);

            $this->id = $row['id'];
        }
    }
?>