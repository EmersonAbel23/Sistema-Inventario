<?php
require_once "../modelo/conexion.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['id_categoria'])) {
  $id_categoria = intval($_POST['id_categoria']);

  $sql = "SELECT p.*, 
                 pr.nombre_proveedor, 
                 c.nombre_categoria, 
                 m.nombre_marca
          FROM producto p
          LEFT JOIN proveedor pr ON p.id_proveedor = pr.id_proveedor
          LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
          LEFT JOIN marca m ON p.id_marca = m.id_marca
          WHERE p.id_categoria = ? AND p.estado = 1";

  $stmt = $conexion->prepare($sql);
  $stmt->bind_param("i", $id_categoria);
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado->num_rows > 0) {
    while ($producto = $resultado->fetch_assoc()) {
      echo '<div class="col-md-6">';
      echo '<div class="card mb-3 shadow-sm border-0">';
      echo '<div class="row g-0 align-items-center">';

      // Imagen
      echo '<div class="col-md-4 text-center">';
      if (!empty($producto['foto'])) {
        $ruta = "../imagenes/" . $producto['foto'];
        echo '<img src="' . $ruta . '" alt="Foto" class="img-fluid rounded-start" style="max-height: 150px; object-fit: cover;">';
      } else {
        echo '<div class="bg-light d-flex align-items-center justify-content-center rounded-start" style="height: 150px;">Sin foto</div>';
      }
      echo '</div>';

      // Datos
      echo '<div class="col-md-8">';
      echo '<div class="card-body">';
      echo '<h5 class="card-title mb-1">' . htmlspecialchars($producto['nombre']) . '</h5>';
      echo '<p class="card-text mb-1"><strong>Precio:</strong> S/ ' . number_format($producto['precio'], 2) . '</p>';
      echo '<p class="card-text mb-1"><strong>Stock:</strong> ' . $producto['stock'] . '</p>';
      echo '<p class="card-text mb-1"><strong>Descripción:</strong> ' . htmlspecialchars($producto['descripcion']) . '</p>';
      echo '<p class="card-text mb-1"><strong>Código:</strong> ' . $producto['codigo_prod'] . '</p>';
      echo '<p class="card-text mb-1"><strong>Proveedor:</strong> ' . htmlspecialchars($producto['nombre_proveedor'] ?? 'No asignado') . '</p>';
      echo '<p class="card-text mb-1"><strong>Categoría:</strong> ' . htmlspecialchars($producto['nombre_categoria'] ?? 'No asignada') . '</p>';
      echo '<p class="card-text mb-1"><strong>Marca:</strong> ' . htmlspecialchars($producto['nombre_marca'] ?? 'No asignada') . '</p>';
      echo '<p class="card-text"><strong>Estado:</strong> ' . ($producto['estado'] == 1 ? 'Activo' : 'Inactivo') . '</p>';
      echo '</div>';
      echo '</div>';

      echo '</div>';
      echo '</div>';
      echo '</div>';
    }
  } else {
    echo '<p class="text-muted">No hay productos en esta categoría.</p>';
  }

  $stmt->close();
  $conexion->close();
} else {
  echo '<p class="text-danger">No se recibió id_categoria.</p>';
}
?>
