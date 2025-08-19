<?php
require_once "../modelo/conexion.php"; 

// FUNCIÓN PARA AGREGAR ENTRADA
function agregarEntrada($conexion, $id_producto, $fecha_entrada, $cantidad, $precio_unitario) {
    // Insertamos en la tabla entrada_producto
    $stmt = $conexion->prepare("INSERT INTO entrada_producto (id_producto, fecha_entrada, cantidad_entrada, precio_unitario) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        return "Error en la preparación de la consulta: " . $conexion->error;
    }

    $stmt->bind_param("isid", $id_producto, $fecha_entrada, $cantidad, $precio_unitario);
    $resultado = $stmt->execute() ? true : "Error al guardar la entrada: " . $stmt->error;
    $stmt->close();

    if ($resultado === true) {
        // Actualizamos el stock en la tabla producto
        $update = $conexion->prepare("UPDATE producto SET stock = stock + ? WHERE id = ?");
        if ($update) {
            $update->bind_param("ii", $cantidad, $id_producto);
            $update->execute();
            $update->close();
        }
    }

    return $resultado;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accion = $_POST["accion"] ?? '';

    if ($accion === "agregar") {
        $id_producto    = intval($_POST["id_producto"]);
        $fecha_entrada  = $_POST["fecha_entrada"];
        $cantidad       = intval($_POST["cantidad_entrada"]);
        $precio_unitario= floatval($_POST["precio_unitario"]);

        if (empty($id_producto) || empty($fecha_entrada) || $cantidad <= 0 || $precio_unitario <= 0) {
            echo "Todos los campos son obligatorios.";
            exit;
        }

        $resultado = agregarEntrada($conexion, $id_producto, $fecha_entrada, $cantidad, $precio_unitario);
        $redireccion = "../Dashboard/entrada_producto.php";

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
