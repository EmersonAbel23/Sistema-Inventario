<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sistema de Inventario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dasboard.css">
    <link rel="shortcut icon" href="../img/logotipoMinired.JPG" type="image/x-icon">
</head>
<body>

<div class="sidebar d-flex flex-column">
  <!-- extrayendo todo el estilo   -->
 <?php   require ("./partials/nav.php") ?>
</div>





<div class="content">
  <div class="d-flex justify-content-between align-items-center px-4 py-3"style="background-color: #343a40; color: white;">
    <div>
      <h4 class="mb-0">Categoria</h4>
    </div>
      <?php require("./partials/topbar.php") ?>
    </div>
</div>
 

  <div class="content">
    <div class="container mt-5">
      <h3 class="mb-4"><i class="fas fa-tag me-2"></i> Categorías</h3>
      <h5 class="text-muted mb-4 ms-4">Nueva categoría</h5>

      <!-- ALERTA DE ÉXITO -->
      <?php if (isset($_GET["success"])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fas fa-check-circle me-2"></i> ¡Categoría guardada con éxito!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
      <?php endif; ?>
<form method="POST" action="../controlador/CategoriaController.php" onsubmit="guardarCategoria(event)" id="formCategoria">
  <input type="hidden" name="accion" value="agregar"> 
  
  <div class="row mb-4">
    <div class="col-md-6">
      <label class="form-label fw-bold">
        Nombre <i class="fas fa-pen-to-square small text-danger"></i>
      </label>
      <input type="text" class="form-control" name="nombre_categoria" placeholder="Ingrese el nombre" required>
    </div>

    <div class="col-md-6">
      <label class="form-label fw-bold">Descripción</label>
      <input type="text" class="form-control" name="descripcion_categoria" placeholder="Descripción opcional">
    </div>
  </div>

  <?php
    require_once "../modelo/conexion.php";
    $sqlProveedores = "SELECT id_rubro, nombre_rubro FROM rubro";
    $resultadoProveedores = $conexion->query($sqlProveedores);
  ?>

  <div class="row mb-4">
    <div class="col-md-6">
      <label class="form-label fw-bold">Rubro <i class="fas fa-briefcase text-secondary small"></i></label>
      <select class="form-select" name="id_rubro" required>
        <option value="">Selecciona un Rubro</option>
        <?php while ($fila = $resultadoProveedores->fetch_assoc()): ?>
          <option value="<?= $fila['id_rubro'] ?>">
            <?= htmlspecialchars($fila['nombre_rubro']) ?>
          </option>
        <?php endwhile; ?>
      </select>
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
    <small>Los campos marcados con <i class="fas fa-pen-to-square small text-danger"></i> son obligatorios</small>
  </div>
</form>


    </div>
  </div>

  <!-- MODAL DE CONFIRMACIÓN -->
  <div class="modal fade" id="categoriaGuardadaModal" tabindex="-1" aria-labelledby="categoriaGuardadaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center">
        <div class="modal-body">
          <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
          <h5 class="modal-title mb-2" id="categoriaGuardadaLabel">¡Categoría guardada!</h5>
          <p class="text-muted">Se ha registrado correctamente.</p>
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Para íconos de colapso en el menú
  document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(link => {
    link.addEventListener("click", function () {
      const icon = this.querySelector(".rotate-icon");
      icon.classList.toggle("open");
    });
  });

  // Mostrar modal antes de enviar el formulario
  function guardarCategoria(event) {
    event.preventDefault(); // Detiene envío inmediato

    const modal = new bootstrap.Modal(document.getElementById('categoriaGuardadaModal'));
    modal.show();

    // Enviar el formulario después de 1.5 segundos
    setTimeout(() => {
      document.getElementById("formCategoria").submit();
    }, 1800);
  }
</script>
</body>
</html>