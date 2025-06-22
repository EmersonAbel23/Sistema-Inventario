<?php
require_once "../modelo/conexion.php"; 

function agregarMarca($conexion, $nombre, $descripcion) {
    $stmt = $conexion->prepare("INSERT INTO marca (nombre, descripcion) VALUES (?, ?)");
    if (!$stmt) {
        return "Error en la preparación de la consulta: " . $conexion->error;
    }

    $stmt->bind_param("ss", $nombre, $descripcion);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error = "Error al guardar la marca: " . $stmt->error;
        $stmt->close();
        return $error;
    }
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
