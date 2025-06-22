<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nuevo Producto</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bootstrap/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="dasboard.css">
  <link rel="shortcut icon" href="../img/logotipoMinired.JPG" type="image/x-icon">
</head>
<body>

<div class="sidebar d-flex flex-column">
  <?php require ("./partials/nav.php") ?>
</div>

<div class="content">
 <div class="d-flex justify-content-between align-items-center px-4 py-3"style="background-color: #343a40; color: white;">
    <div>
      <h4 class="mb-0">Producto</h4>
    </div>
    <?php require("./partials/topbar.php") ?>
  </div>
</div>

  <div class="container mt-5">
    <h3 class="mb-4"><i class="fas fa-box me-2"></i> Nuevo Producto</h3>

    <?php if (isset($_GET["success"])): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> ¡Producto guardado con éxito!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
      </div>
    <?php endif; ?>

    <form method="POST" action="../controlador/ProductoController.php" onsubmit="guardarProducto(event)" id="formProducto" enctype="multipart/form-data">
      <input type="hidden" name="accion" value="agregar">
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label fw-bold">Nombre <i class="fas fa-pen-to-square small"></i></label>
          <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="col-md-3">
          <label class="form-label fw-bold">Precio</label>
          <input type="number" class="form-control" name="precio" required>
        </div>
        <div class="col-md-3">
          <label class="form-label fw-bold">Stock</label>
          <input type="number" class="form-control" name="stock">
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label fw-bold">Descripción</label>
          <input type="text" class="form-control" name="descripcion">
        </div>
        <div class="col-md-6">
          <label class="form-label fw-bold">Código Producto</label>
          <input type="text" class="form-control" name="codigo_prod">
        </div>
      </div>

    <div class="row mb-3">
<?php
require_once "../modelo/conexion.php";

// Obtener proveedores
$sqlProveedores = "SELECT id_proveedor, nombre_proveedor FROM proveedor";
$resultadoProveedores = $conexion->query($sqlProveedores);

// Obtener categorías
$sqlCategorias = "SELECT id_categoria, nombre_categoria FROM categoria WHERE estado = 1";
$resultadoCategorias = $conexion->query($sqlCategorias);
?> 

   <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label fw-bold">Proveedor</label>
          <select class="form-select" name="id_proveedor" required>
            <option value="">Selecciona un proveedor</option>
            <?php while ($fila = $resultadoProveedores->fetch_assoc()): ?>
              <option value="<?= $fila['id_proveedor'] ?>">
                <?= htmlspecialchars($fila['nombre_proveedor']) ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

  <div class="col-md-6">
          <label class="form-label fw-bold">Categoría</label>
          <select class="form-select" name="id_categoria" required>
            <option value="">Selecciona una categoría</option>
            <?php while ($fila = $resultadoCategorias->fetch_assoc()): ?>
              <option value="<?= $fila['id_categoria'] ?>">
                <?= htmlspecialchars($fila['nombre_categoria']) ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

<div class="row mb-3">
    <!-- Campo de imagen -->
    <div class="col-md-6">
      <label class="form-label fw-bold">Foto del producto</label>
      <input type="file" class="form-control" name="foto" accept="image/*">
      <small class="form-text text-muted">Formatos permitidos: JPG, PNG, GIF.</small>
    </div>
  </div>

      <div class="text-center">
        <button type="reset" class="btn btn-outline-primary me-2">
          <i class="fas fa-filter-circle-xmark"></i> Limpiar
        </button>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-floppy-disk"></i> Guardar
        </button>
      </div>

      <div class="text-muted mt-3 text-center">
        <small>Los campos marcados con <i class="fas fa-pen-to-square small"></i> son obligatorios</small>
      </div>
    </form>
  </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="productoGuardadoModal" tabindex="-1" aria-labelledby="productoGuardadoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-body">
        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
        <h5 class="modal-title mb-2" id="productoGuardadoLabel">¡Producto guardado!</h5>
        <p class="text-muted">Se ha registrado correctamente.</p>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
  function guardarProducto(event) {
    event.preventDefault();
    const modal = new bootstrap.Modal(document.getElementById('productoGuardadoModal'));
    modal.show();
    setTimeout(() => {
      document.getElementById("formProducto").submit();
    }, 1500);
  }
</script>

</body>
</html>
