<?php

    namespace App\Model;


    class ProjetoDao{

        //CRUD projeto
        public function create(Projeto $p){

            $sql = 'INSERT INTO projetos (tipo_projeto,ano,id,autor,link,assunto,anotacao) VALUES (?,?,?,?,?,?,?)';

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $p->getTipo_Projeto());
            $stmt->bindValue(2, $p->getAno());
            $stmt->bindValue(3, $p->getId());
            $stmt->bindValue(4, $p->getAutor());
            $stmt->bindValue(5, $p->getLink());
            $stmt->bindValue(6, $p->getAssunto());
            $stmt->bindValue(7, $p->getAnotacao());
            $stmt->execute(); 
        }

        public function read($busca,$projeto,$ano,$inicio,$quantidade_pg){

            $sql = "SELECT * ";
            $sql.= "FROM projetos "; 
            $sql.= "WHERE tipo_projeto = '$projeto' and ano = '$ano' and (id LIKE '%$busca%' OR autor LIKE '%$busca%' OR assunto LIKE '%$busca%') ";
            $sql.= "LIMIT $quantidade_pg OFFSET $inicio";

            $stmt = DB::getCon()->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0):
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            endif;

        }

        public function readId($Id){

            $sql = "SELECT * ";
            $sql.= "FROM projetos WHERE id = ?";

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $Id);
            $stmt->execute();

            if($stmt->rowCount() > 0):
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            endif;

        }

        public function update(Projeto $p){

            $sql = 'UPDATE projetos SET tipo_projeto = ?, ano = ?, autor = ?, link = ?, assunto = ?, anotacao = ? WHERE id = ?';

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $p->getTipo_Projeto());
            $stmt->bindValue(2, $p->getAno());
            $stmt->bindValue(3, $p->getAutor());
            $stmt->bindValue(4, $p->getLink());
            $stmt->bindValue(5, $p->getAssunto());
            $stmt->bindValue(6, $p->getAnotacao());
            $stmt->bindValue(7, $p->getId());
            $stmt->execute();

        } 

        public function delete($Id){

            $sql = 'DELETE FROM projetos WHERE id = ?';

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $Id);
            $stmt->execute();
            
        }
    }
?>