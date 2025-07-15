<?php
require_once "../modelo/conexion.php"; 

function agregarMarca($conexion, $nombre, $descripcion) {
    $stmt = $conexion->prepare("INSERT INTO marca (nombre_marca, descripcion) VALUES (?, ?)");
    if (!$stmt) {
        return "Error en la preparación de la consulta: " . $conexion->error;
    }

    $stmt->bind_param("ss", $nombre, $descripcion);
    $resultado = $stmt->execute() ? true : "Error al guardar la marca: " . $stmt->error;
    $stmt->close();
    return $resultado;
}

function actualizarCategoria($conexion, $id_marca, $nombre, $descripcion) {
    $stmt = $conexion->prepare("UPDATE marca SET nombre_marca = ?, descripcion = ? WHERE id_marca = ?");
    if (!$stmt) {
        return "Error en la preparación de la consulta: " . $conexion->error;
    }

    $stmt->bind_param("ssi", $nombre, $descripcion, $id_marca);
    $resultado = $stmt->execute() ? true : "Error al actualizar la marca: " . $stmt->error;
    $stmt->close();
    return $resultado;
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accion = $_POST["accion"] ?? '';

    if ($accion === "agregar") {
        $nombre = trim($_POST["nombre_marca"]);
        $descripcion = trim($_POST["descripcion_marca"]);

        if (empty($nombre)) {
            echo "El nombre de la marca es obligatorio.";
            exit;
        }

        $resultado = agregarMarca($conexion, $nombre, $descripcion);
        $redireccion = "../Dashboard/marca.php";

    } elseif ($accion === "actualizar") {
        $id_marca = intval($_POST["id_marca"]);
        $nombre = trim($_POST["nombre_marca"]);
        $descripcion = trim($_POST["descripcion_marca"]);

        if (empty($nombre)) {
            echo "El nombre de la marca es obligatorio.";
            exit;
        }

        $resultado = actualizarCategoria($conexion, $id_marca, $nombre, $descripcion);
        $redireccion = "../Dashboard/lista_marca.php?success=actualizada";

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
