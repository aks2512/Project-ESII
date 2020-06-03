<?php
        include "conexao.php";

            $id = $_POST['id'];

            $i = count($id)-1;

            while($i>=0)
            {
                $comp = $id[$i];
                $sql = "DELETE FROM detalhes WHERE '$comp' = id";

                if (mysqli_query($conn, $sql)) {
                } else {
                    echo utf8_encode("Erro: " . $sql . "<br>" . mysqli_error($conn));
                }

                $sql = "DELETE FROM funcionarios_BD WHERE '$comp' = id";

                if (mysqli_query($conn, $sql)) {
                } else {
                    echo utf8_encode("Erro: " . $sql . "<br>" . mysqli_error($conn));
                }
                $i--;
            }
?>