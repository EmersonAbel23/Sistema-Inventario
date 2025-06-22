<?php
session_start();
require_once "../modelo/conexion.php"; // tu conexión

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_user'], $_POST['admin_pass'])) {
    $usuario = $_POST['admin_user'];
    $clave = $_POST['admin_pass'];

    $sql = "SELECT * FROM usuario WHERE user = ? AND password = ? AND estado = 1";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $usuario, $clave);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows === 1) {
        $datos = $resultado->fetch_assoc();

        if ($datos['id_rol'] == 1) { // Rol 1 = Administrador
            $_SESSION['autorizado_admin'] = true;
            header("Location: ../Dashboard/lista_usuario.php?admin=ok");
            exit;
        }
    }
}

// Si falló, volver y mostrar el modal nuevamente
$_SESSION['autorizado_admin'] = false;
header("Location: ../Dashboard/lista_usuario.php");
exit;
