<?php

session_start();
$_SESSION['ip_user'] = $_SERVER['REMOTE_ADDR'];

if (isset($_GET['positivo'])) {
    echo "ok positivo/ip:" . $_SESSION['ip_user'] . " Codigo Projeto/" . $_GET['codigo'];
}
if (isset($_GET['negativo'])) {
    echo "ok negativo/ip:" . $_SESSION['ip_user'] . " Codigo Projeto/" . $_GET['codigo'];
}
