<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sistema de Inventario</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bootstrap/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="dasboard.css">
</head>
<body>

<div class="sidebar d-flex flex-column">
  <?php require("./partials/nav.php") ?>
</div>

<div class="content">
  <div class="header-bar">
    Inicio
  </div>
  <div class="page-content">
    <h5>¡Bienvenido al sistema de inventario!</h5>
    <div class="row mt-4 g-4">

      <?php
      require_once "../modelo/conexion.php";

      function contarRegistros($tabla) {
        global $conexion;
        $cantidad = 0;
        $sql = "SELECT COUNT(*) AS total FROM $tabla WHERE estado = 1";
        if ($resultado = $conexion->query($sql)) {
          if ($fila = $resultado->fetch_assoc()) {
            $cantidad = $fila['total'];
          }
        }
        return $cantidad;
      }
      ?>

      <!-- Productos -->
      <div class="col-sm-6 col-md-4 col-lg-3">
        <a href="../Dashboard/lista_producto.php" style="text-decoration: none; color: inherit;">
          <div class="summary-box">
            <i class="fas fa-box"></i>
            <div class="summary-title">Productos</div>
            <div class="summary-number"><?= contarRegistros('producto') ?></div>
          </div>
        </a>
      </div>

      <!-- Categorías -->
      <div class="col-sm-6 col-md-4 col-lg-3">
        <a href="../Dashboard/lista_categoria.php" style="text-decoration: none; color: inherit;">
          <div class="summary-box">
            <i class="fas fa-tags"></i>
            <div class="summary-title">Categorías</div>
            <div class="summary-number"><?= contarRegistros('categoria') ?></div>
          </div>
        </a>
      </div>

      <!-- Rubros -->
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="summary-box">
          <i class="fas fa-layer-group"></i>
          <div class="summary-title">Rubros</div>
          <div class="summary-number"><?= contarRegistros('categoria') ?></div>
        </div>
      </div>

      <!-- Marcas -->
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="summary-box">
          <i class="fas fa-trademark"></i>
          <div class="summary-title">Marcas</div>
          <div class="summary-number"><?= contarRegistros('marca') ?></div>
        </div>
      </div>

      <!-- Proveedores -->
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="summary-box">
          <i class="fas fa-truck"></i>
          <div class="summary-title">Proveedores</div>
          <div class="summary-number"><?= contarRegistros('proveedor') ?></div>
        </div>
      </div>

   <!-- Usuarios -->
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="summary-box">
          <i class="fas fa-user me-2"></i>
          <div class="summary-title">Usuarios</div>
          <div class="summary-number"><?= contarRegistros('usuario') ?></div>
        </div>
      </div>

    </div>
  </div>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
  document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(link => {
    link.addEventListener("click", function () {
      const icon = this.querySelector(".rotate-icon");
      icon.classList.toggle("open");
    });
  });
</script>

</body>
</html>
