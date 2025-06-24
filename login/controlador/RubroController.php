<?php
require_once "../modelo/conexion.php"; 

function agregarRubro($conexion, $nombre, $descripcion) {
    $stmt = $conexion->prepare("INSERT INTO rubro (nombre_rubro, descripcion_rubro) VALUES (?, ?)");
    if (!$stmt) {
        return "Error en la preparación de la consulta: " . $conexion->error;
    }

    $stmt->bind_param("ss", $nombre, $descripcion);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error = "Error al guardar el rubro: " . $stmt->error;
        $stmt->close();
        return $error;
    }
}

function actualizarRubro($conexion, $id_rubro, $nombre, $descripcion) {
    $stmt = $conexion->prepare("UPDATE rubro SET nombre_rubro = ?, descripcion_rubro = ? WHERE id_rubro = ?");
    if (!$stmt) {
        return "Error en la preparación de la consulta: " . $conexion->error;
    }

    $stmt->bind_param("ssi", $nombre, $descripcion, $id_rubro);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error = "Error al actualizar el rubro: " . $stmt->error;
        $stmt->close();
        return $error;
    }
}

function desactivarRubro($conexion, $id_rubro) {
    $stmt = $conexion->prepare("UPDATE rubro SET estado = 0 WHERE id_rubro = ?");
    if (!$stmt) {
        return "Error al preparar la desactivación: " . $conexion->error;
    }

    $stmt->bind_param("i", $id_rubro);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error = "Error al desactivar el rubro: " . $stmt->error;
        $stmt->close();
        return $error;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accion = $_POST["accion"] ?? '';

    if ($accion === "actualizar") {
        $nombre = trim($_POST["nombre_rubro"]);
        $descripcion = trim($_POST["descripcion_rubro"]);
        if (empty($nombre)) {
            echo "El nombre del rubro es obligatorio.";
            exit;
        }

        $id = intval($_POST["id_rubro"]);
        $resultado = actualizarRubro($conexion, $id, $nombre, $descripcion);
        $redireccion = "../Dashboard/lista_rubro.php";

    } elseif ($accion === "eliminar") {
        $id = intval($_POST["id_rubro"]);
        $resultado = desactivarRubro($conexion, $id);
        $redireccion = "../Dashboard/lista_rubro.php";

    } elseif ($accion === "agregar") {
        $nombre = trim($_POST["nombre_rubro"]);
        $descripcion = trim($_POST["descripcion_rubro"]);

        if (empty($nombre)) {
            echo "El nombre del rubro es obligatorio.";
            exit;
        }

        $resultado = agregarRubro($conexion, $nombre, $descripcion);
        $redireccion = "../Dashboard/rubro.php";

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
