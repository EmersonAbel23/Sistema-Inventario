<?php
require_once "../modelo/conexion.php"; // tu archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente   = $_POST['cliente'];
    $productos = $_POST['productos']; // array con id, cantidad y precio

    // calcular total
    $total = 0;
    foreach ($productos as $p) {
        $subtotal = $p['cantidad'] * $p['precio'];
        $total += $subtotal;
    }

    // insertar en tabla venta
    $sqlVenta = "INSERT INTO venta (cliente, total) VALUES ('$cliente', '$total')";
    if ($conexion->query($sqlVenta)) {
        $id_venta = $conexion->insert_id;

        // insertar detalle de la venta y actualizar stock
        foreach ($productos as $p) {
            $id_producto = $p['id'];
            $cantidad    = $p['cantidad'];
            $precio      = $p['precio'];

            // detalle
            $sqlDetalle = "INSERT INTO detalle_venta (id_venta, id_producto, cantidad, precio_unitario) 
                           VALUES ('$id_venta', '$id_producto', '$cantidad', '$precio')";
            $conexion->query($sqlDetalle);

            // actualizar stock del producto
            $sqlStock = "UPDATE producto SET stock = stock - $cantidad WHERE id = $id_producto";
            $conexion->query($sqlStock);
        }

        // redirigir con mensaje de éxito
        header("Location: ../Dashboard/venta.php?success=1");
        exit();
    } else {
        header("Location: ../Dashboard/venta.php?error=1");
        exit();
    }
}
