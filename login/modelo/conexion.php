<?php 

// Configuración de la base de datos
$host = "localhost";  
$usuario = "root";
$contrasena = "";
$base_de_datos = "mini_red";

// Crear una conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);
$conexion->set_charset("utf8");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}



?>



