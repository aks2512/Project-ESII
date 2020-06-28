<?php

    namespace App\Model;


    class FuncionarioCamaraDao{

        //CRUD funcionario
        public function create(FuncionarioCamara $f){

            try{
                $sql = 'INSERT INTO funcionarios_camara (rgf,nome,cargo,vencimento_base,outros_vencimentos,previdencia,outros_descontos,tbruto,tliquido,tdesconto,irrf) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
    
                $stmt = DB::getCon()->prepare($sql);
                $stmt->bindValue(1, $f->getRgf());
                $stmt->bindValue(2, $f->getNome());
                $stmt->bindValue(3, $f->getCargo());
                $stmt->bindValue(4, $f->getVencimento_Base());
                $stmt->bindValue(5, $f->getOutros_Vencimentos());
                $stmt->bindValue(6, $f->getPrevidencia());
                $stmt->bindValue(7, $f->getOutrosDescontos());
                $stmt->bindValue(8, $f->getTBruto());
                $stmt->bindValue(9, $f->getTLiquido());
                $stmt->bindValue(10, $f->getTDesconto());
                $stmt->bindValue(11, $f->getIRRF());
                $stmt->execute();
            }catch(Exception $e){
                $e->getMessage();
            }
            
        }

        public function read($busca,$inicio,$quantidade_pg){

            $sql = "SELECT * FROM funcionarios_camara WHERE nome LIKE '%$busca%' OR cargo LIKE '%$busca%' OR tbruto LIKE '%$busca%' LIMIT $quantidade_pg OFFSET $inicio";

            $stmt = DB::getCon()->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0):
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            endif;

        }

        public function readRgf($rgf){

            $sql = "SELECT * FROM funcionarios_camara WHERE rgf = '$rgf'";

            $stmt = DB::getCon()->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0):
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            endif;


        }

        public function update(FuncionarioCamara $f){

            $sql = 'UPDATE funcionarios_camara SET cargo = ?, vencimento_base = ?, outros_vencimentos = ?, previdencia = ?, outros_descontos = ?, tbruto = ?, tliquido = ?, tdesconto = ?, irrf = ? WHERE rgf = ?';

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $f->getCargo());
            $stmt->bindValue(2, $f->getVencimento_Base());
            $stmt->bindValue(3, $f->getOutros_Vencimentos());
            $stmt->bindValue(4, $f->getPrevidencia());
            $stmt->bindValue(5, $f->getOutrosDescontos());
            $stmt->bindValue(6, $f->getTBruto());
            $stmt->bindValue(7, $f->getTLiquido());
            $stmt->bindValue(8, $f->getTDesconto());
            $stmt->bindValue(9, $f->getIRRF());
            $stmt->bindValue(10, $f->getRgf());
            $stmt->execute();

        } 

        public function delete($Rgf){

            $sql = 'DELETE FROM funcionarios_camara WHERE rgf = ?';

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $Rgf);
            $stmt->execute();
            
        }

    }

?>