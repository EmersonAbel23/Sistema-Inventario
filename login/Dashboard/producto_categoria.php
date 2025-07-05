<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Categoría por Producto</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bootstrap/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="dasboard.css">
  <link rel="shortcut icon" href="../img/logotipoMinired.JPG" type="image/x-icon">
</head>
<body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<?php 
require_once "../modelo/conexion.php";

$sql = "SELECT * FROM categoria WHERE estado = 1";
$resultado = $conexion->query($sql);
?>

<script>
$(document).ready(function(){
  $('.ver-productos').on('click', function(){
    let categoriaId = $(this).data('id');
    let nombreCategoria = $(this).data('nombre');
    
    $('#modalProductosLabel').text("Productos de " + nombreCategoria);
    $('#contenido-productos').html('<p class="text-center text-muted">Cargando productos...</p>');

    $.ajax({
      url: '../controlador/cargar_producto.php',
      type: 'POST',
      data: { id_categoria: categoriaId },
      success: function(respuesta) {
        $('#contenido-productos').html(respuesta);
      },
      error: function() {
        $('#contenido-productos').html('<p class="text-danger">Error al cargar productos.</p>');
      }
    });
  });
});
</script>

<div class="sidebar d-flex flex-column">
  <?php require("./partials/nav.php") ?>
</div>


<div class="content">
  <div class="d-flex justify-content-between align-items-center px-4 py-3" style="background-color: #343a40; color: white;">
    <div>
      <h4 class="mb-0">Categoría / Producto </h4>
    </div>
    <?php require("./partials/topbar.php") ?>
  </div>
</div>
  

  <div class="page-content">
    <h3 class="mb-4"><i class="fas fa-box me-2"></i> Categoría por Producto</h3>

    <div class="container mt-4">
      <h3 class="mb-4 text-center"><i class="fas fa-cubes me-2 text-success "></i>Categorías</h3>
      <div class="row justify-content-center">
        <?php while ($fila = $resultado->fetch_assoc()): ?>
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card text-center border-0 shadow-sm rounded-3 h-100">
              <div class="card-body">
                <div class="mb-3">
                  <i class="fas fa-layer-group fa-2x text-dark"></i>
                </div>
                <h5 class="card-title fw-bold"><?= htmlspecialchars($fila['nombre_categoria']) ?></h5>
                <p class="card-text small text-muted"><?= htmlspecialchars($fila['descripcion_categoria']) ?></p>
                <a href="#" 
                  class="btn btn-sm btn-primary mt-2 ver-productos"
                  data-bs-toggle="modal" 
                  data-bs-target="#modalProductos" 
                  data-id="<?= $fila['id_categoria'] ?>" 
                  data-nombre="<?= htmlspecialchars($fila['nombre_categoria']) ?>">
                  <i class="fas fa-boxes-stacked me-1"></i> Ver productos
                </a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="modalProductosLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="modalProductosLabel">Productos</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <div id="contenido-productos" class="row g-3"></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
