<?php

    namespace App\Model;

    class AdministradorDao{

        public function create(Administrador $a){
            $sql = 'INSERT INTO administradores (usuario,senha) VALUES (?,?)';

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $a->getUsuario());
            $stmt->bindValue(2, MD5($a->getSenha()));
            $stmt->execute();
        }

<<<<<<< HEAD
=======
        public function verificaAdm($usuario,$senha){
            $sql = "SELECT * FROM administradores WHERE usuario = ? and senha = ? ";

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $usuario);
            $stmt->bindValue(2, $senha);
            $stmt->execute();

            if($stmt->rowCount() > 0):
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            endif;
        }

>>>>>>> 01d1e1d0880203c5f92f1e6b02a47820c7cc162e
        public function update(Administrador $a){
            $sql = 'UPDATE administradores SET usuario = ?, senha = ? WHERE id = ?';

            $stmt = DB::getCon()->prepare($sql);
            $stmt->bindValue(1, $a->getUsuario());
            $stmt->bindValue(2, MD5($a->getSenha()));
            $stmt->bindValue(3, $a->getId());
            $stmt->execute();
        }

    }

?>