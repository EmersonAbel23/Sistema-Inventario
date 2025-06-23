<?php
require_once "../modelo/conexion.php"; 

function agregarCategoria($conexion, $nombre, $descripcion, $id_rubro) {
    $stmt = $conexion->prepare("INSERT INTO categoria (nombre_categoria, descripcion_categoria, id_rubro) VALUES (?, ?, ?)");
    if (!$stmt) {
        return "Error en la preparación de la consulta: " . $conexion->error;
    }

    $stmt->bind_param("ssi", $nombre, $descripcion, $id_rubro);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error = "Error al guardar la categoría: " . $stmt->error;
        $stmt->close();
        return $error;
    }
}

function actualizarCategoria($conexion, $id_categoria, $nombre, $descripcion) {
    $stmt = $conexion->prepare("UPDATE categoria SET nombre_categoria = ?, descripcion_categoria = ? WHERE id_categoria = ?");
    if (!$stmt) {
        return "Error en la preparación de la consulta: " . $conexion->error;
    }

    $stmt->bind_param("ssi", $nombre, $descripcion, $id_categoria);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error = "Error al actualizar la categoría: " . $stmt->error;
        $stmt->close();
        return $error;
    }
}

function desactivarCategoria($conexion, $id_categoria) {
    $stmt = $conexion->prepare("UPDATE categoria SET estado = 0 WHERE id_categoria = ?");
    if (!$stmt) {
        return "Error al preparar la desactivación: " . $conexion->error;
    }

    $stmt->bind_param("i", $id_categoria);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error = "Error al desactivar la categoría: " . $stmt->error;
        $stmt->close();
        return $error;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accion = $_POST["accion"] ?? '';

    if ($accion === "actualizar") {
        $nombre = trim($_POST["nombre_categoria"]);
        $descripcion = trim($_POST["descripcion_categoria"]);
        if (empty($nombre)) {
            echo "El nombre de la categoría es obligatorio.";
            exit;
        }

        $id = intval($_POST["id_categoria"]);
        $resultado = actualizarCategoria($conexion, $id, $nombre, $descripcion);
        $redireccion = "../Dashboard/lista_categoria.php";

    } elseif ($accion === "eliminar") {
        $id = intval($_POST["id_categoria"]);
        $resultado = desactivarCategoria($conexion, $id);
        $redireccion = "../Dashboard/lista_categoria.php";

    } elseif ($accion === "agregar") {
        $nombre = trim($_POST["nombre_categoria"]);
        $descripcion = trim($_POST["descripcion_categoria"]);
        $id_rubro = trim($_POST["id_rubro"]); 
        if (empty($nombre)) {
            echo "El nombre de la categoría es obligatorio.";
            exit;
        }

        $resultado = agregarCategoria($conexion, $nombre, $descripcion , $id_rubro);
        $redireccion = "../Dashboard/categoria.php";
        
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
