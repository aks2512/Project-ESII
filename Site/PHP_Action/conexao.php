<?php 

   // Create connection
   $conn = mysqli_connect("localhost", "root", "", "transparenciamc");
   // Check connection
   if (!$conn) {
       die("Falha na conexao: " . mysqli_connect_error());
   }

?>