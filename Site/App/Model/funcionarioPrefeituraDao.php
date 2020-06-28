<?php

    namespace App\Model;


    class FuncionarioPrefeituraDao{

        //CRUD das remunerações e descontos
        static private function inserirValoresMonetarios($Rgf, $Categoria, $ArrayObject){
        
            foreach ($ArrayObject as $key => $value) {
                $sql = 'INSERT INTO '.$Categoria.' (rgf,nome,valor) VALUES (?,?,?)';
                $stmt = DB::getCon()->prepare($sql);
                $stmt->bindValue(1, $Rgf);
                $stmt->bindValue(2, $value->getNome());
                $stmt->bindValue(3, $value->getValor());
                $stmt->execute();
            }
        
            
        }

        static private function inserirValorMonetario($Rgf, $Categoria, $Object){
        
            $sql = 'INSERT INTO '.$Categoria.' (rgf,nome,valor) VALUES (?,?,?)';
            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $Rgf);
            $stmt->bindValue(2, $Object->getNome());
            $stmt->bindValue(3, $Object->getValor());
            $stmt->execute();
        
            
        }

        static private function atualizarValoresMonetarios($Rgf, $Categoria, $ArrayObject){
        
            foreach ($ArrayObject as $key => $value) {
                if($value->getId() != NULL && $value->getDelete() == "true"){                                 // deletar valor monetario
                    $Id_item = $value->getId();
                    FuncionarioPrefeituraDao::deleteValorMonetario($Rgf,$Id_item,$Categoria);
                    echo $value->getNome().' deletado<br>';
                }elseif($value->getId() != NULL && $value->getDelete() == "false"){                           // atualiza valor monetario
                    $sql = 'UPDATE '.$Categoria.' SET nome = ?, valor = ? WHERE rgf = ? and id_item = ?';
                    $stmt = DB::getCon()->prepare($sql);
                    $stmt->bindValue(1, $value->getNome());
                    $stmt->bindValue(2, $value->getValor());
                    $stmt->bindValue(3, $Rgf);
                    $stmt->bindValue(4, $value->getId());
                    $stmt->execute();
                    echo $value->getNome().' atualizado<br>';
                }elseif($value->getId() == NULL && $value->getDelete() == "false"){                           // inserir valor monetario
                    FuncionarioPrefeituraDao::inserirValorMonetario($Rgf, $Categoria, $value);
                    echo $value->getNome().' inserido<br>';
                }
            }
        
            
        }
        
        static public function readValoresMonetarios($rgf,$Categoria){
            
            $sql = 'SELECT * FROM '.$Categoria.' WHERE rgf = '.$rgf;

            $stmt = DB::getCon()->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0):
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            endif;

        }

        static public function deleteValoresMonetarios($Rgf,$Categoria){
            
            $sql = 'DELETE FROM '.$Categoria.' WHERE rgf = ?';
            
            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $Rgf);
            $stmt->execute();
            
            
        }

        static public function deleteValorMonetario($Rgf,$Id_item,$Categoria){
            
            $sql = 'DELETE FROM '.$Categoria.' WHERE rgf = ? and id_item = ?';
            
            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $Rgf);
            $stmt->bindValue(2, $Id_item);
            $stmt->execute();
            
            
        }

        //CRUD funcionario
        public function create(FuncionarioPrefeitura $f){

            $remuneracoes = $f->getRemuneracoes();
            $descontos = $f->getDescontos();

            $sql = 'INSERT INTO funcionarios_prefeitura (nome,cargo,regime,outros_descontos,tbruto,tdesconto,tliquido,rgf) VALUES (?,?,?,?,?,?,?,?)';

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $f->getNome());
            $stmt->bindValue(2, $f->getCargo());
            $stmt->bindValue(3, $f->getRegime());
            $stmt->bindValue(4, $f->getOutrosDescontos());
            $stmt->bindValue(5, $f->getTbruto());
            $stmt->bindValue(6, $f->getTDesconto());
            $stmt->bindValue(7, $f->getTLiquido());
            $stmt->bindValue(8, $f->getRgf());
            $stmt->execute();

            $Rgf = $f->getRgf();

            FuncionarioPrefeituraDao::inserirValoresMonetarios($Rgf, 'remuneracoes', $remuneracoes);
            FuncionarioPrefeituraDao::inserirValoresMonetarios($Rgf, 'descontos', $descontos);
            
        }

        public function read($busca,$inicio,$quantidade_pg){

            $sql = "SELECT id,nome,cargo,tbruto,rgf FROM funcionarios_prefeitura WHERE nome LIKE '%$busca%' OR cargo LIKE '%$busca%' OR tbruto LIKE '%$busca%' LIMIT $quantidade_pg OFFSET $inicio";

            $stmt = DB::getCon()->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0):
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            endif;

        }

        public function readRgf($rgf){

            $sql = "SELECT * FROM funcionarios_prefeitura WHERE rgf = '$rgf'";

            $stmt = DB::getCon()->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0):
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            endif;


        }

        public function update(FuncionarioPrefeitura $f){

            $sql = 'UPDATE funcionarios_prefeitura SET cargo = ?, regime = ?, outros_descontos = ?, tbruto = ?, tdesconto = ?, tliquido = ? WHERE rgf = ?';

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $f->getCargo());
            $stmt->bindValue(2, $f->getRegime());
            $stmt->bindValue(3, $f->getOutrosDescontos());
            $stmt->bindValue(4, $f->getTBruto());
            $stmt->bindValue(5, $f->getTDesconto());
            $stmt->bindValue(6, $f->getTLiquido());
            $stmt->bindValue(7, $f->getRgf());
            $stmt->execute();

            $Rgf = $f->getRgf();

            $remuneracoes = $f->getRemuneracoes();
            $descontos = $f->getDescontos();

            FuncionarioPrefeituraDao::atualizarValoresMonetarios($Rgf, 'remuneracoes', $remuneracoes);
            FuncionarioPrefeituraDao::atualizarValoresMonetarios($Rgf, 'descontos', $descontos);

        } 

        public function delete($Rgf){

            $sql = 'DELETE FROM funcionarios_prefeitura WHERE rgf = ?';

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $Rgf);
            $stmt->execute();

            FuncionarioPrefeituraDao::deleteValoresMonetarios($Rgf,'remuneracoes');
            FuncionarioPrefeituraDao::deleteValoresMonetarios($Rgf,'descontos');
            
        }

    }

?>