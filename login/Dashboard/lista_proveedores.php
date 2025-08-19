<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sistema de Inventario - Lista de Proveedores</title>
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
      <h4 class="mb-0">Lista de Proveedores</h4>
    </div>
    <?php require("./partials/topbar.php") ?>
  </div>
</div>

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">  
    <h3 class="mb-4"><i class="fas fa-truck-field me-2"></i> Proveedores</h3>
    <h5 class="text-muted mb-4 ms-4">Lista de proveedores registrados</h5>
    <div>
      <button class="btn btn-danger" onclick="exportarProveedoresPDF()">
        <i class="fas fa-file-pdf me-2"></i> Exportar PDF
      </button>
    </div>
  </div>

  <!-- BUSCADOR -->
  <div class="mb-3">
    <input type="text" class="form-control" id="buscador" placeholder="Buscar proveedor...">
  </div>

  <!-- TABLA -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover text-center" id="tablaProveedores">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Teléfono</th>
          <th>Dirección</th>
          <th>Correo</th>
          <th>Actualizar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
      <?php
      require_once "../modelo/conexion.php";
      $sql = "SELECT * FROM proveedor WHERE estado = 1";
      $resultado = $conexion->query($sql);
      $contador = 1;

      if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $contador++ . "</td>";
          echo "<td>" . htmlspecialchars($fila['nombre_proveedor']) . "</td>";
          echo "<td>" . htmlspecialchars($fila['telefono']) . "</td>";
          echo "<td>" . htmlspecialchars($fila['direccion']) . "</td>";
          echo "<td>" . htmlspecialchars($fila['correo']) . "</td>";
          echo '<td><button class="btn btn-success btn-sm btn-actualizar" data-id="' . $fila['id_proveedor'] . '"><i class="fas fa-rotate"></i></button></td>';
          echo '<td><button class="btn btn-danger btn-sm btn-eliminar" data-id="' . $fila['id_proveedor'] . '"><i class="fas fa-trash"></i></button></td>';
          
         echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='7'>No se encontraron proveedores.</td></tr>";
      }
      $conexion->close();
      ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal de Actualización -->
<div class="modal fade" id="modalActualizarProveedor" tabindex="-1" aria-labelledby="modalActualizarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../controlador/ProveedorController.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="modalActualizarLabel">Actualizar Proveedor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_proveedor" id="editar_id_proveedor">
          <div class="mb-3">
            <label for="editar_nombre_proveedor" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre_proveedor" id="editar_nombre_proveedor" required>
          </div>
          <div class="mb-3">
            <label for="editar_telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="editar_telefono">
          </div>
          <div class="mb-3">
            <label for="editar_direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" name="direccion" id="editar_direccion">
          </div>
          <div class="mb-3">
            <label for="editar_correo" class="form-label">Correo</label>
            <input type="email" class="form-control" name="correo" id="editar_correo">
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
<div class="modal fade" id="modalEliminarProveedor" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../controlador/ProveedorController.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEliminarLabel">¿Eliminar proveedor?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_proveedor" id="eliminar_id_proveedor">
          <p>¿Estás seguro de que deseas eliminar este proveedor?</p>
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
  // Abrir modal de actualización
  document.querySelectorAll(".btn-actualizar").forEach(btn => {
    btn.addEventListener("click", function () {
      const fila = this.closest("tr");
      const id = this.dataset.id;
      const nombre = fila.cells[1].textContent;
      const telefono = fila.cells[2].textContent;
      const direccion = fila.cells[3].textContent;
      const correo = fila.cells[4].textContent;

      document.getElementById("editar_id_proveedor").value = id;
      document.getElementById("editar_nombre_proveedor").value = nombre;
      document.getElementById("editar_telefono").value = telefono;
      document.getElementById("editar_direccion").value = direccion;
      document.getElementById("editar_correo").value = correo;

      new bootstrap.Modal(document.getElementById('modalActualizarProveedor')).show();
    });
  });

  // Abrir modal de eliminación
  document.querySelectorAll(".btn-eliminar").forEach(btn => {
    btn.addEventListener("click", function () {
      const id = this.dataset.id;
      document.getElementById("eliminar_id_proveedor").value = id;
      new bootstrap.Modal(document.getElementById('modalEliminarProveedor')).show();
    });
  });

  // Buscador en tabla
  document.getElementById("buscador").addEventListener("keyup", function () {
    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll("#tablaProveedores tbody tr");

    filas.forEach(fila => {
      let nombre = fila.cells[1].textContent.toLowerCase();
      fila.style.display = nombre.includes(filtro) ? "" : "none";
    });
  });

  // Exportar a PDF
  async function exportarProveedoresPDF() {
    const { jsPDF } = window.jspdf;
    const tabla = document.querySelector(".table-responsive"); 
    const canvas = await html2canvas(tabla, {
      scale: 2,
      backgroundColor: "#ffffff"
    });

    const imgData = canvas.toDataURL("image/png");
    const pdf = new jsPDF("p", "mm", "a4");

    const pageWidth = pdf.internal.pageSize.getWidth();
    const imgProps = pdf.getImageProperties(imgData);
    const imgWidth = pageWidth - 20;
    const imgHeight = (imgProps.height * imgWidth) / imgProps.width;

    pdf.setFontSize(16);
    pdf.setTextColor(40);
    pdf.text("Proveedores - Mini-Red", 10, 15);

    pdf.addImage(imgData, "PNG", 10, 20, imgWidth, imgHeight);
    pdf.save("proveedores.pdf");
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
