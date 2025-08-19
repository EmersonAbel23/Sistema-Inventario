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
      <h4 class="mb-0">Historial de salida de producto</h4>
    </div>
    <?php require("./partials/topbar.php") ?>
  </div>
</div>

  <div class="container mt-5">
  <h3 class="mb-4"><i class="fa-solid fa-clock-rotate-left"></i> Salida de Producto</h3>
  <h5 class="text-muted mb-4 ms-4">Lista de Salidas</h5>

  <!-- BUSCADOR -->
  <div class="mb-3">
    <input type="text" class="form-control" id="buscador" placeholder="Buscar...">
  </div>

<!-- TABLA -->
<div class="table-responsive">
  <table class="table table-bordered table-hover text-center" id="tablaHistorial">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Motivo</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require_once "../modelo/conexion.php"; 

      // Consultar todo el historial de salidas
      $sql = "SELECT s.id_salida, s.id_producto, p.nombre AS nombre_producto, 
                     s.cantidad_salida, s.motivo, s.fecha_salida
              FROM salida_producto s
              INNER JOIN producto p ON s.id_producto = p.id
              ORDER BY s.fecha_salida DESC";

      $resultado = $conexion->query($sql);
      $contador = 1;

      if ($resultado && $resultado->num_rows > 0) {
          while ($fila = $resultado->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $contador++ . "</td>";
              echo "<td>" . htmlspecialchars($fila['nombre_producto']) . "</td>";
              echo "<td>" . htmlspecialchars($fila['cantidad_salida']) . "</td>";
              echo "<td>" . htmlspecialchars($fila['motivo']) . "</td>";
              echo "<td>" . htmlspecialchars($fila['fecha_salida']) . "</td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='5'>No se encontraron registros de salida.</td></tr>";
      }

      $conexion->close();
      ?>
    </tbody>
  </table>
</div>



<script>
  // BUSCADOR
  document.getElementById("buscador").addEventListener("keyup", function () {
    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll("#tablaHistorial tbody tr");

    filas.forEach(fila => {
      let producto = fila.cells[1].textContent.toLowerCase();
      let motivo   = fila.cells[3].textContent.toLowerCase();
      let fecha    = fila.cells[4].textContent.toLowerCase();

      // Buscar en Producto, Motivo y Fecha
      fila.style.display = (producto.includes(filtro) || motivo.includes(filtro) || fecha.includes(filtro)) ? "" : "none";
    });
  });
</script>


<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
