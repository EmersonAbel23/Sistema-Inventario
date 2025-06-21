<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sistema de Inventario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dasboard.css">
</head>
<body>

<div class="sidebar d-flex flex-column">
  <!-- extrayendo todo el estilo   -->
 <?php   require ("./partials/nav.php") ?>
</div>

<div class="content">
 <?php require("./partials/topbar.php") ?>
  

  <div class="container mt-5">
  <h3 class="mb-4"><i class="fas fa-user me-2"></i> Usuarios</h3>
  <h5 class="text-muted mb-4 ms-4">Lista de Usuarios</h5>

  <!-- BUSCADOR -->
  <div class="mb-3">
    <input type="text" class="form-control" id="buscador" placeholder="Buscar usuario...">
  </div>

  <!-- TABLA -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover text-center" id="tablaCategorias">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>user</th>
          <th>Actualizar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>

      <?php
require_once "../modelo/conexion.php";

$sql = "SELECT * FROM usuario WHERE estado = 1";
$resultado = $conexion->query($sql);
$contador = 1;

if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $contador++ . "</td>";
        echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['apellido']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['user']) . "</td>";
        //echo '<td><button class="btn btn-primary btn-sm"><i class="fas fa-boxes-stacked"></i></button></td>';
        echo '<td><button class="btn btn-success btn-sm btn-actualizar" data-id="' . $fila['id'] . '"><i class="fas fa-rotate"></i></button></td>';
       echo '<td><button class="btn btn-danger btn-sm btn-eliminar" data-id="' . $fila['id'] . '"><i class="fas fa-trash"></i></button></td>';

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No se encontraron usuarios.</td></tr>";
}

$conexion->close();
?>
</tbody>





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

<!-- Modal de Actualización -->
<div class="modal fade" id="modalActualizarCategoria" tabindex="-1" aria-labelledby="modalActualizarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form  id="formUsuario" action="../controlador/UsuarioController.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="modalActualizarLabel">Actualizar Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="editar_id_usuario">
          <div class="mb-3">
            <label for="editar_nombre_usuario" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="editar_nombre_usuario" required>
          </div>
          <div class="mb-3">
            <label for="editar_apellido_usuario" class="form-label">Apellido</label>
            <input type="text" class="form-control" name="apellido" id="editar_apellido_usuario" required>
          </div>
          <div class="mb-3">
            <label for="editar_correo_usuario" class="form-label">Correo</label>
            <input type="text" class="form-control" name="correo" id="editar_correo_usuario" required>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="accion" value="actualizar">
          <button type="button" class="btn btn-primary" onclick="abrirConfirmacion()">Guardar cambios</button>

        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalConfirmarActualizacion" tabindex="-1" aria-labelledby="confirmarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-body">
        <i class="fas fa-question-circle fa-3x text-warning mb-3"></i>
        <h5 class="modal-title mb-2" id="confirmarLabel">¿Confirmar actualización?</h5>
        <p class="text-muted">¿Estás seguro de que deseas actualizar este usuario?</p>
        <div class="d-flex justify-content-center gap-3">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="enviarFormulario()">Sí, actualizar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function abrirConfirmacion() {
  const modalEditar = bootstrap.Modal.getInstance(document.getElementById('modalActualizarCategoria'));
  if (modalEditar) {
    modalEditar.hide();
  }

  setTimeout(() => {
    const modalConfirmar = new bootstrap.Modal(document.getElementById('modalConfirmarActualizacion'));
    modalConfirmar.show();
  }, 400);
}


function enviarFormulario() {
  const modalConfirmar = bootstrap.Modal.getInstance(document.getElementById('modalConfirmarActualizacion'));
  if (modalConfirmar) {
    modalConfirmar.hide();
  }


  setTimeout(() => {
    const form = document.getElementById("formUsuario");
    if (form) {
      form.submit();
    } else {
      console.error("Formulario no encontrado: id='formUsuario'");
    }
  }, 300);
}
</script>

<!-- Modal de Confirmación para Eliminar -->
<div class="modal fade" id="modalEliminarUsuario" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../controlador/UsuarioController.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEliminarLabel">¿Eliminar usuario?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_usuario" id="eliminar_id_usuario">
          <p>¿Estás seguro de que deseas eliminar esta usuario?</p>
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
  // para actualizar el usuarios
  document.querySelectorAll(".btn-actualizar").forEach(btn => {
    btn.addEventListener("click", function () {
      const fila = this.closest("tr");
      const id = this.dataset.id;
      const nombre = fila.cells[1].textContent;
      const apellido = fila.cells[2].textContent;
      //editar_correo_usuario
      const correo = fila.cells[3].textContent;


      document.getElementById("editar_id_usuario").value = id;
      document.getElementById("editar_nombre_usuario").value = nombre;
      document.getElementById("editar_apellido_usuario").value = apellido;
      document.getElementById("editar_correo_usuario").value = correo;

      new bootstrap.Modal(document.getElementById('modalActualizarCategoria')).show();
    });
  });

  document.querySelectorAll(".btn-eliminar").forEach(btn => {
  btn.addEventListener("click", function () {
    const id = this.dataset.id;
    document.getElementById("eliminar_id_usuario").value = id;
    new bootstrap.Modal(document.getElementById('modalEliminarUsuario')).show();
  });
});



</script>









<!-- SCRIPT DEL BUSCADOR -->
<script>
document.getElementById("buscador").addEventListener("keyup", function () {
  let filtro = this.value.toLowerCase();
  let filas = document.querySelectorAll("#tablaCategorias tbody tr");

  filas.forEach(fila => {
    let nombre = fila.cells[1].textContent.toLowerCase();
    fila.style.display = nombre.includes(filtro) ? "" : "none";
  });
});
</script>

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