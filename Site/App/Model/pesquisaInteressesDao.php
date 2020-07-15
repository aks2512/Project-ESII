<?php

    namespace App\Model;

    class PesquisaInteressesDao{

        public function create(PesquisaInteresses $p){
            $sql = 'INSERT INTO pesquisa_interesses (ip,filtro,tabela) VALUES (?,?,?)';

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $p->getIp());
            $stmt->bindValue(2, $p->getFiltro());
            $stmt->bindValue(3, $p->getTabela());
            $stmt->execute();
        }

        public function read($inicio,$quantidade_pg){
            $sql = "SELECT * FROM pesquisa_interesses LIMIT $quantidade_pg OFFSET $inicio";

            $stmt = DB::getCon()->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0):
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            endif;
        }

    }

?>