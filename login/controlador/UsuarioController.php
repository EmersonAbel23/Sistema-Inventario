<?php
require_once "../modelo/conexion.php"; 

function actualizarUsuario($conexion, $id, $nombre, $apellido ,$correo) {
    $stmt = $conexion->prepare("UPDATE usuario SET nombre = ?, apellido = ?  ,user = ? WHERE id = ?");
    if (!$stmt) {
        return "Error en la preparación de la consulta: " . $conexion->error;
    }

    $stmt->bind_param("sssi",$nombre, $apellido ,$correo, $id);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error = "Error al actualizar la categoría: " . $stmt->error;
        $stmt->close();
        return $error;
    }
}

function desactivarUsuario($conexion, $id_categoria) {
    $stmt = $conexion->prepare("UPDATE usuario SET estado = 0 WHERE id = ?");
    if (!$stmt) {
        return "Error al preparar la desactivación: " . $conexion->error;
    }

    $stmt->bind_param("i", $id_categoria);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error = "Error al desactivar el usuario: " . $stmt->error;
        $stmt->close();
        return $error;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accion = $_POST["accion"] ?? '';

    if ($accion === "actualizar") {
        $nombre = trim($_POST["nombre"]);
        $apellido = trim($_POST["apellido"]);
        $correo = trim($_POST["correo"]);
        if (empty($nombre)) {
            echo "El nombre de la categoría es obligatorio.";
            exit;
        }

        $id = intval($_POST["id"]);
        $resultado = actualizarUsuario($conexion, $id, $nombre, $apellido ,$correo);
        $redireccion = "../Dashboard/lista_usuario.php";

    } elseif ($accion === "eliminar") {
        $id = intval($_POST["id_usuario"]);
        $resultado = desactivarUsuario($conexion, $id);
        $redireccion = "../Dashboard/lista_usuario.php";

    }  else {
        echo "Acción no válida.";
        exit;
    }

    $conexion->close();

    if ($resultado === true) {
        header("Location: $redireccion?success=1");
        exit;
    } else {
        echo $resultado;
    }

} else {
    echo "Acceso no permitido.";
}
