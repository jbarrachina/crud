<?php

// usado para conectar a la base de datos

$host = "localhost";
$db_name = "ausias";
$username = "root";
$password = "ausias";

$conexion = new mysqli($host, $username, $password, $db_name);

if ($conexion->connect_errno) { // Si se produce algún error finaliza con mensaje de error
    die("Error de Conexión: " . $conexion->connect_error);
}
$conexion->set_charset("utf8");
?>

