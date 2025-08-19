<?php
require_once "../modelo/conexion.php"; 

// FUNCIÓN PARA AGREGAR SALIDA
function agregarSalida($conexion, $id_producto, $fecha_salida, $cantidad_salida, $motivo) {
    // Insertamos en la tabla salida_producto
    $stmt = $conexion->prepare("INSERT INTO salida_producto (id_producto, fecha_salida, cantidad_salida, motivo) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        return "Error en la preparación de la consulta: " . $conexion->error;
    }

    $stmt->bind_param("isis", $id_producto, $fecha_salida, $cantidad_salida, $motivo);
    $resultado = $stmt->execute() ? true : "Error al guardar la salida: " . $stmt->error;
    $stmt->close();

    if ($resultado === true) {
        // Verificamos stock actual antes de restar
        $check = $conexion->prepare("SELECT stock FROM producto WHERE id = ?");
        $check->bind_param("i", $id_producto);
        $check->execute();
        $check->bind_result($stock_actual);
        $check->fetch();
        $check->close();

        if ($stock_actual < $cantidad_salida) {
            return "Error: La cantidad de salida excede el stock disponible.";
        }

        // Actualizamos el stock en la tabla producto
        $update = $conexion->prepare("UPDATE producto SET stock = stock - ? WHERE id = ?");
        if ($update) {
            $update->bind_param("ii", $cantidad_salida, $id_producto);
            $update->execute();
            $update->close();
        }
    }

    return $resultado;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accion = $_POST["accion"] ?? '';

    if ($accion === "agregar") {
        $id_producto     = intval($_POST["id_producto"]);
        $fecha_salida    = $_POST["fecha_salida"];
        $cantidad_salida = intval($_POST["cantidad_salida"]);
        $motivo          = trim($_POST["motivo"]);

        if (empty($id_producto) || empty($fecha_salida) || $cantidad_salida <= 0 || empty($motivo)) {
            echo "Todos los campos son obligatorios.";
            exit;
        }

        $resultado = agregarSalida($conexion, $id_producto, $fecha_salida, $cantidad_salida, $motivo);
        $redireccion = "../Dashboard/salida_producto.php";

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
