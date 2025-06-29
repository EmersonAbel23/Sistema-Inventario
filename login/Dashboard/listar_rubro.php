<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sistema de Inventario - Lista de Rubros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="dasboard.css">
  <link rel="shortcut icon" href="../img/logotipoMinired.JPG" type="image/x-icon">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

</head>
<body>

<div class="sidebar d-flex flex-column">
  <?php require("./partials/nav.php") ?>
</div>

<div class="content">
  <div class="d-flex justify-content-between align-items-center px-4 py-3" style="background-color: #343a40; color: white;">
    <div>
      <h4 class="mb-0">Lista de Rubros</h4>
    </div>
    <?php require("./partials/topbar.php") ?>
  </div>
</div>

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">  
    <h3 class="mb-4"><i class="fas fa-layer-group me-2"></i> Rubros</h3>
      <h5 class="text-muted mb-4 ms-4">Lista de rubros registrados</h5>
      <div>
          <button class="btn btn-danger" onclick="exportarRubrosPDF()">
          <i class="fas fa-boxes me-2"></i> Exportar PDF
        </button>
      </div>
  </div>

  <!-- BUSCADOR -->
  <div class="mb-3">
    <input type="text" class="form-control" id="buscador" placeholder="Buscar rubro...">
  </div>

  <!-- TABLA -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover text-center" id="tablaRubros">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Actualizar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
      <?php
      require_once "../modelo/conexion.php";
      $sql = "SELECT * FROM rubro WHERE estado = 1";
      $resultado = $conexion->query($sql);
      $contador = 1;

      if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $contador++ . "</td>";
          echo "<td>" . htmlspecialchars($fila['nombre_rubro']) . "</td>";
          echo "<td>" . htmlspecialchars($fila['descripcion_rubro']) . "</td>";
          echo '<td><button class="btn btn-success btn-sm btn-actualizar" data-id="' . $fila['id_rubro'] . '"><i class="fas fa-rotate"></i></button></td>';
          echo '<td><button class="btn btn-danger btn-sm btn-eliminar" data-id="' . $fila['id_rubro'] . '"><i class="fas fa-trash"></i></button></td>';
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='5'>No se encontraron rubros.</td></tr>";
      }
      $conexion->close();
      ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal de Actualización -->
<div class="modal fade" id="modalActualizarRubro" tabindex="-1" aria-labelledby="modalActualizarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../controlador/RubroController.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="modalActualizarLabel">Actualizar Rubro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_rubro" id="editar_id_rubro">
          <div class="mb-3">
            <label for="editar_nombre_rubro" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre_rubro" id="editar_nombre_rubro" required>
          </div>
          <div class="mb-3">
            <label for="editar_descripcion_rubro" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion_rubro" id="editar_descripcion_rubro" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="accion" value="actualizar" class="btn btn-primary">Guardar cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal de Confirmación para Eliminar -->
<div class="modal fade" id="modalEliminarRubro" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../controlador/RubroController.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEliminarLabel">¿Eliminar rubro?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_rubro" id="eliminar_id_rubro">
          <p>¿Estás seguro de que deseas eliminar este rubro?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name="accion" value="eliminar" class="btn btn-danger">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.querySelectorAll(".btn-actualizar").forEach(btn => {
    btn.addEventListener("click", function () {
      const fila = this.closest("tr");
      const id = this.dataset.id;
      const nombre = fila.cells[1].textContent;
      const descripcion = fila.cells[2].textContent;

      document.getElementById("editar_id_rubro").value = id;
      document.getElementById("editar_nombre_rubro").value = nombre;
      document.getElementById("editar_descripcion_rubro").value = descripcion;

      new bootstrap.Modal(document.getElementById('modalActualizarRubro')).show();
    });
  });

  document.querySelectorAll(".btn-eliminar").forEach(btn => {
    btn.addEventListener("click", function () {
      const id = this.dataset.id;
      document.getElementById("eliminar_id_rubro").value = id;
      new bootstrap.Modal(document.getElementById('modalEliminarRubro')).show();
    });
  });

  document.getElementById("buscador").addEventListener("keyup", function () {
    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll("#tablaRubros tbody tr");

    filas.forEach(fila => {
      let nombre = fila.cells[1].textContent.toLowerCase();
      fila.style.display = nombre.includes(filtro) ? "" : "none";
    });
  });
</script>

<script>
  async function exportarRubrosPDF() {
    const { jsPDF } = window.jspdf;

    const tabla = document.querySelector(".table-responsive"); 
        const canvas = await html2canvas(tabla, {
      scale: 2,
      backgroundColor: "#ffffff"
    });

    const imgData = canvas.toDataURL("image/png");
    const pdf = new jsPDF("p", "mm", "a4");

    const pageWidth = pdf.internal.pageSize.getWidth();
    const pageHeight = pdf.internal.pageSize.getHeight();

    const imgProps = pdf.getImageProperties(imgData);
    const imgWidth = pageWidth - 20;
    const imgHeight = (imgProps.height * imgWidth) / imgProps.width;

    pdf.setFontSize(16);
    pdf.setTextColor(40);
    pdf.text("Rubros - Mini-Red", 10, 15);

    pdf.addImage(imgData, "PNG", 10, 20, imgWidth, imgHeight);
    pdf.save("rubros.pdf");
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
