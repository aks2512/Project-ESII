<?php

    namespace App\Model;


    class ProjetoDao{

        //CRUD projeto
        public function create(Projeto $p){

            $sql = 'INSERT INTO projetos (tipo_projeto,ano,codigo,autor,link,assunto,anotacao) VALUES (?,?,?,?,?,?,?)';

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

            $inicio = (int)$inicio;
            $quantidade_pg = (int)$quantidade_pg;
            $like = '%' . $busca . '%';
            $sql  = "SELECT * ";
            $sql .= "FROM projetos "; 
            $sql .= "WHERE tipo_projeto = ? and ano = ? and (codigo LIKE ? OR autor LIKE ? OR assunto LIKE ? OR anotacao LIKE ?) ";
            $sql .= "LIMIT $quantidade_pg OFFSET $inicio";

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $projeto);
            $stmt->bindValue(2, $ano);
            $stmt->bindValue(3, $like);
            $stmt->bindValue(4, $like);
            $stmt->bindValue(5, $like);
            $stmt->bindValue(6, $like);
            $stmt->execute();

            if($stmt->rowCount() > 0):
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            endif;

        }

        public function readId($Id){

            $sql = "SELECT * ";
            $sql.= "FROM projetos WHERE codigo = ?";

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $Id);
            $stmt->execute();

            if($stmt->rowCount() > 0):
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            endif;

        }

        public function update(Projeto $p){

            $sql = 'UPDATE projetos SET tipo_projeto = ?, ano = ?, autor = ?, link = ?, assunto = ?, anotacao = ? WHERE codigo = ?';

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

            $sql = 'DELETE FROM projetos WHERE codigo = ?';

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $Id);
            $stmt->execute();
            
        }
    }
?>