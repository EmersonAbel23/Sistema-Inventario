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
     <h4 class="mb-0">Lista de Marcas</h4>
  </div>
    <?php require("./partials/topbar.php") ?>
  </div>
</div>
  

  <div class="container mt-5">
  <h3 class="mb-4"><i class="fas fa-gem me-2"></i> Marcas</h3>
  <h5 class="text-muted mb-4 ms-4">Lista de marcas</h5>

  <!-- BUSCADOR -->
  <div class="mb-3">
    <input type="text" class="form-control" id="buscador" placeholder="Buscar marcas...">
  </div>

    <!-- TABLA -->
    <div class="table-responsive">
      <table class="table table-bordered table-hover text-center" id="tablaMarcas">
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
          $sql = "SELECT * FROM marca WHERE estado = 1";
          $resultado = $conexion->query($sql);
          $contador = 1;

          if ($resultado && $resultado->num_rows > 0) {
              while ($fila = $resultado->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $contador++ . "</td>";
                  echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                  echo "<td>" . htmlspecialchars($fila['descripcion']) . "</td>";
                  echo '<td><button class="btn btn-success btn-sm btn-actualizar" data-id="' . $fila['id_marca'] . '"><i class="fas fa-rotate"></i></button></td>';
                  echo '<td><button class="btn btn-danger btn-sm btn-eliminar" data-id="' . $fila['id_marca'] . '"><i class="fas fa-trash"></i></button></td>';
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='5'>No se encontraron marcas.</td></tr>";
          }

          $conexion->close();
          ?>
        </tbody>
      </table>
    </div>

  <!-- PAGINACIÓN (opcional) -->
  <div class="d-flex justify-content-between align-items-center mt-3">
    <button class="btn btn-secondary btn-sm" disabled>◄ Anterior</button>
    <span class="badge bg-primary rounded-circle p-2">1</span>
    <button class="btn btn-secondary btn-sm" disabled>Siguiente ►</button>
  </div>

  <div class="text-end text-muted mt-2">
    Mostrando categorías <strong>1 al 5</strong> de un <strong>total de 5</strong>
  </div>
</div>
    <!-- MODAL ACTUALIZAR MARCA -->
    <div class="modal fade" id="modalActualizarMarca" tabindex="-1" aria-labelledby="modalActualizarLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="../controlador/MarcaController.php" method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="modalActualizarLabel">Actualizar Marca</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id_marca" id="editar_id_marca">
              <div class="mb-3">
                <label for="editar_nombre_marca" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre_categoria" id="editar_nombre_marca" required>
              </div>
              <div class="mb-3">
                <label for="editar_descripcion_marca" class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion_categoria" id="editar_descripcion_marca" rows="3"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="accion" value="actualizar" class="btn btn-primary">Guardar cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>



    <!-- MODAL ELIMINAR MARCA -->
    <div class="modal fade" id="modalEliminarMarca" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="../controlador/MarcaController.php" method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="modalEliminarLabel">¿Eliminar marca?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id_marca" id="eliminar_id_marca">
              <p>¿Estás seguro de que deseas eliminar esta marca?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" name="accion" value="eliminar" class="btn btn-danger">Eliminar</button>
            </div>
          </form>
        </div>
      </div>
    </div>



    <!-- BUSCADOR SCRIPT -->
    <script>
      document.getElementById("buscador").addEventListener("keyup", function () {
        let filtro = this.value.toLowerCase();
        let filas = document.querySelectorAll("#tablaMarcas tbody tr");

        filas.forEach(fila => {
          let nombre = fila.cells[1].textContent.toLowerCase();
          let descripcion = fila.cells[2].textContent.toLowerCase();
          fila.style.display = nombre.includes(filtro) ? "" : "none";
           fila.style.display = descripcion.includes(filtro) ? "" : "none";
        });
      });

      // Llenar datos en modal de actualizar
      document.querySelectorAll(".btn-actualizar").forEach(btn => {
        btn.addEventListener("click", function () {
          const fila = this.closest("tr");
          const id = this.dataset.id;
          const nombre = fila.cells[1].textContent;
          const descripcion = fila.cells[2].textContent;

          document.getElementById("editar_id_marca").value = id;
          document.getElementById("editar_nombre_marca").value = nombre;
          document.getElementById("editar_descripcion_marca").value = descripcion;

          new bootstrap.Modal(document.getElementById('modalActualizarMarca')).show();
        });
      });

      // Llenar datos en modal de eliminar
      document.querySelectorAll(".btn-eliminar").forEach(btn => {
        btn.addEventListener("click", function () {
          const id = this.dataset.id;
          document.getElementById("eliminar_id_marca").value = id;
          new bootstrap.Modal(document.getElementById('modalEliminarMarca')).show();
        });
      });
    </script>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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