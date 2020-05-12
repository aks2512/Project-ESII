<?php
                       $Nome = $_POST['Nome'];
                       $Cargo = $_POST['Cargo'];
                       $Remuneracao = $_POST['Remuneracao'];
                       $Modificado = $_POST['ModificadoEm'];
                       $Regime = $_POST['Regime'];
                       $Tbruto = $_POST['TBruto'];
                       $Tliquido = $_POST['Tliquido'];
                       $Tdescontos = $_POST['TDescontos'];
                       $DescontosObr = $_POST['DescontosObgr'];
                       $OutrosDescontos = $_POST['OutrosDescontos'];

                       $nomeservidor = "127.0.0.1";
                       $nomeusuario = "root";
                       $senha = "";
                       $bancodedados = "transparenciamc";

                           // Create connection
                            $conn = mysqli_connect($nomeservidor, $nomeusuario, $senha, $bancodedados);
                            // Check connection
                            if (!$conn) {
                            die("Falha na conexao: " . mysqli_connect_error());
                            }

                            $sql = "INSERT INTO Funcionarios_BD ".
                            "(id, Nome, Cargo, Remuneracao, Modificado, Regime, TBruto, Tliquido, TDescontos, DescontosObgr, OutrosDescontos) ".
                            "VALUES"."('NULL' , '$Nome', '$Cargo', '$Remuneracao', '$Modificado', '$Regime', '$Tbruto', '$Tliquido', '$Tdescontos', '$DescontosObr' , '$OutrosDescontos')";

                            if (mysqli_query($conn, $sql)) {
                            echo "Dados inseridos com sucesso!";
                            } else {
                            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
                            }

                            mysqli_close($conn);
                            
                            ?>
                                                
                                                    $conn = null;
                   
?>