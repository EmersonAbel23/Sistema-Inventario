
<?php
require_once "../modelo/conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["accion"])) {
    $accion = $_POST["accion"];

    switch ($accion) {
        case "agregar":
            agregarProducto($conexion);
            break;
        
        case "actualizar":
            actualizarProducto($conexion);
            break;
    }
}
function agregarProducto($conexion) {
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $descripcion = $_POST["descripcion"];
    $codigo = $_POST["codigo_prod"];
    $id_proveedor = $_POST["id_proveedor"];
    $id_categoria = $_POST["id_categoria"];
    $foto = null;

    // Manejar la imagen
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === 0) {
        $carpeta_destino = "../imagenes/";
        if (!is_dir($carpeta_destino)) {
            mkdir($carpeta_destino, 0755, true);
        }

        $nombre_archivo = basename($_FILES["foto"]["name"]);
        $ruta_archivo = $carpeta_destino . $nombre_archivo;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta_archivo)) {
            $foto = $nombre_archivo;
        }
    }

    $stmt = $conexion->prepare("INSERT INTO producto (nombre, precio, stock, descripcion, codigo_prod, id_proveedor, id_categoria, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error en la preparación: " . $conexion->error);
    }

    $stmt->bind_param("siissiis", $nombre, $precio, $stock, $descripcion, $codigo, $id_proveedor, $id_categoria, $foto);

    if ($stmt->execute()) {
        header("Location: ../Dashboard/producto.php?success=1");
        exit;
    } else {
        echo "Error al guardar el producto: " . $stmt->error;
    }

    $stmt->close();
}



function actualizarProducto($conexion) {
    $id = $_POST["id_producto"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $descripcion = $_POST["descripcion"];
    $codigo = $_POST["codigo_prod"];
    $id_proveedor = $_POST["id_proveedor"];
    $id_categoria = $_POST["id_categoria"];
    $foto = null;

    // Buscar foto actual
    $consulta = $conexion->prepare("SELECT foto FROM producto WHERE id = ?");
    $consulta->bind_param("i", $id);
    $consulta->execute();
    $consulta->bind_result($foto_actual);
    $consulta->fetch();
    $consulta->close();

    // Verificar si se subió una nueva foto
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === 0) {
        $carpeta_destino = "../imagenes/";
        if (!is_dir($carpeta_destino)) {
            mkdir($carpeta_destino, 0755, true);
        }

        $nombre_archivo = basename($_FILES["foto"]["name"]);
        $ruta_archivo = $carpeta_destino . $nombre_archivo;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta_archivo)) {
            $foto = $nombre_archivo;
        }
    } else {
        $foto = $foto_actual; // Mantener la foto anterior si no se sube nueva
    }

    $stmt = $conexion->prepare("UPDATE producto SET nombre = ?, precio = ?, stock = ?, descripcion = ?, codigo_prod = ?, id_proveedor = ?, id_categoria = ?, foto = ? WHERE id = ?");
    if (!$stmt) {
        die("Error al preparar la actualización: " . $conexion->error);
    }

    $stmt->bind_param("siisssisi", $nombre, $precio, $stock, $descripcion, $codigo, $id_proveedor, $id_categoria, $foto, $id);

    if ($stmt->execute()) {
        header("Location: ../Dashboard/lista_producto.php?actualizado=1");
        exit;
    } else {
        echo "Error al actualizar el producto: " . $stmt->error;
    }

    $stmt->close();
}
?>

