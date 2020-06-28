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