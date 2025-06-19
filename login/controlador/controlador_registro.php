<?php

include '../modelo/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $nombre    = trim($_POST['nombre']);
    $apellido  = trim($_POST['apellido']);
    $correo    = trim($_POST['correo']); 
    $password  = trim($_POST['password']);

    
    if (empty($nombre) || empty($apellido) || empty($correo) || empty($password)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    
    $check = $conexion->prepare("SELECT id FROM usuario WHERE user = ?");
    $check->bind_param("s", $correo);
    $check->execute();
    $check->store_result();
    
    if ($check->num_rows > 0) {
        echo "Este correo ya está registrado.";
        $check->close();
        exit;
    }
    $check->close();

 
  

  
    $sql = "INSERT INTO usuario (user, password, nombre, apellido) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $correo, $password, $nombre, $apellido);

        if ($stmt->execute()) {
            header("Location: ../index.php");
        } else {
            echo "Error al registrar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la preparación del SQL.";
    }

    $conexion->close();
} else {
    echo "Acceso no permitido.";
}
?>
