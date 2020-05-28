<?php
//Log off do sistema
session_start();
session_destroy();
 
header("Location: ../login.php");
?>