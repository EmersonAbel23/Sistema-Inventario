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
  <?php require("./partials/nav.php") ?>
</div>

<div class="content">
  <div class="d-flex justify-content-between align-items-center px-4 py-3" style="background-color: #343a40; color: white;">
    <div>
      <h4 class="mb-0">Salidas de Producto</h4>
    </div>
    <?php require("./partials/topbar.php") ?>
  </div>
</div>

<div class="content">
  <div class="container mt-5">
    <h3 class="mb-4"><i class="fas fa-dolly me-2"></i>Salidas de Producto</h3>
    <h5 class="text-muted mb-4 ms-4">Nueva Salida</h5>

    <!-- ALERTA DE ÉXITO -->
    <?php if (isset($_GET["success"])): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> ¡Salida registrada con éxito!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
      </div>
    <?php endif; ?>

    <form method="POST" action="../controlador/controlador_salida.php" onsubmit="guardarSalida(event)" id="formSalida">
      <input type="hidden" name="accion" value="agregar"> 

      <div class="row mb-4">
        <div class="col-md-6">
          <label class="form-label fw-bold">Producto <i class="fas fa-pen-to-square small"></i></label>
          <select class="form-select" name="id_producto" required>
            <option value="">-- Seleccionar Producto --</option>
            <?php
              require_once "../modelo/conexion.php";
              $sql = $conexion->query("SELECT id, nombre FROM producto");
              while ($row = $sql->fetch_assoc()) {
                echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
              }
            ?>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label fw-bold">Fecha de Salida <i class="fas fa-pen-to-square small"></i></label>
          <input type="date" class="form-control" name="fecha_salida" required>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-6">
          <label class="form-label fw-bold">Cantidad <i class="fas fa-pen-to-square small"></i></label>
          <input type="number" class="form-control" name="cantidad_salida" min="1" required>
        </div>
        <div class="col-md-6">
          <label class="form-label fw-bold">Motivo <i class="fas fa-pen-to-square small"></i></label>
          <input type="text" class="form-control" name="motivo" placeholder="Ej: Venta, Donación, Defectuoso" required>
        </div>
      </div>

      <div class="text-center">
        <button type="reset" class="btn btn-outline-primary me-2">
          <i class="fas fa-filter-circle-xmark"></i> Limpiar
        </button>
        <button type="submit" class="btn btn-danger">
          <i class="fas fa-paper-plane"></i> Registrar Salida
        </button>
      </div>

      <div class="text-muted mt-3 text-center">
        <small>Los campos marcados con <i class="fas fa-pen-to-square small"></i> son obligatorios</small>
      </div>
    </form>

  </div>
</div>

<!-- MODAL DE CONFIRMACIÓN -->
<div class="modal fade" id="salidaGuardadaModal" tabindex="-1" aria-labelledby="salidaGuardadaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-body">
        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
        <h5 class="modal-title mb-2" id="salidaGuardadaLabel">¡Salida registrada!</h5>
        <p class="text-muted">Se ha guardado correctamente.</p>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function guardarSalida(event) {
    event.preventDefault();
    const modal = new bootstrap.Modal(document.getElementById('salidaGuardadaModal'));
    modal.show();
    setTimeout(() => {
      document.getElementById("formSalida").submit();
    }, 1800);
  }
</script>
</body>
</html>
