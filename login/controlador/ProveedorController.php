<?php
require_once "../modelo/conexion.php"; 

function agregarProveedor($conexion, $nombre, $telefono, $direccion, $correo) {
    $stmt = $conexion->prepare("INSERT INTO proveedor (nombre_proveedor, telefono, direccion, correo, estado) VALUES (?, ?, ?, ?, 1)");
    if (!$stmt) {
        return "Error en la preparación de la consulta: " . $conexion->error;
    }

    $stmt->bind_param("ssss", $nombre, $telefono, $direccion, $correo);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error = "Error al guardar el proveedor: " . $stmt->error;
        $stmt->close();
        return $error;
    }
}

function actualizarProveedor($conexion, $id_proveedor, $nombre, $telefono, $direccion, $correo) {
    $stmt = $conexion->prepare("UPDATE proveedor 
        SET nombre_proveedor = ?, telefono = ?, direccion = ?, correo = ? 
        WHERE id_proveedor = ?");
    if (!$stmt) {
        return "Error en la preparación de la consulta: " . $conexion->error;
    }

    $stmt->bind_param("ssssi", $nombre, $telefono, $direccion, $correo, $id_proveedor);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error = "Error al actualizar el proveedor: " . $stmt->error;
        $stmt->close();
        return $error;
    }
}

function desactivarProveedor($conexion, $id_proveedor) {
    $stmt = $conexion->prepare("UPDATE proveedor SET estado = 0 WHERE id_proveedor = ?");
    if (!$stmt) {
        return "Error al preparar la desactivación: " . $conexion->error;
    }

    $stmt->bind_param("i", $id_proveedor);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error = "Error al desactivar el proveedor: " . $stmt->error;
        $stmt->close();
        return $error;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accion = $_POST["accion"] ?? '';

    if ($accion === "actualizar") {
        $nombre = trim($_POST["nombre_proveedor"]);
        $telefono = trim($_POST["telefono"] ?? '');
        $direccion = trim($_POST["direccion"] ?? '');
        $correo = trim($_POST["correo"] ?? '');

        if (empty($nombre)) {
            echo "El nombre del proveedor es obligatorio.";
            exit;
        }

        $id = intval($_POST["id_proveedor"]);
        $resultado = actualizarProveedor($conexion, $id, $nombre, $telefono, $direccion, $correo);
        $redireccion = "../Dashboard/lista_proveedores.php";

    } elseif ($accion === "eliminar") {
        $id = intval($_POST["id_proveedor"]);
        $resultado = desactivarProveedor($conexion, $id);
        $redireccion = "../Dashboard/lista_proveedores.php";

    } elseif ($accion === "agregar") {
        $nombre = trim($_POST["nombre_proveedor"]);
        $telefono = trim($_POST["telefono"] ?? '');
        $direccion = trim($_POST["direccion"] ?? '');
        $correo = trim($_POST["correo"] ?? '');

        if (empty($nombre)) {
            echo "El nombre del proveedor es obligatorio.";
            exit;
        }

        $resultado = agregarProveedor($conexion, $nombre, $telefono, $direccion, $correo);
        $redireccion = "../Dashboard/proveedores.php";

    } else {
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
