<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//obtener los valores del formulario
$usuario = $_POST['usuario'];
$password = $_POST['password'];

//creamos una variable de conexión
$conexion = new mysqli("localhost","root","ausias","ausias");
if ($conexion->connect_errno){
    die("Error de conexión a la base de datos: ".$conexion->connect_error);
}

//preparamos la consulta
$sql = "SELECT * "
        . "FROM profesores "
        . "WHERE login='$usuario' AND password='$password'";


echo $sql, "<br>";
$result = new mysqli_result(); //para que complete
$result = $conexion->query($sql);

if ($result->num_rows==1){
   echo "Login Correcto";    
}
 else {
   echo "Login Incorrecto";
}




