
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
  <h3 class="mb-4"><i class="fas fa-box me-2"></i>Productos</h3>
  <h5 class="text-muted mb-4 ms-4">Lista de Producto</h5>

  <!-- BUSCADOR -->
  <div class="mb-3">
    <input type="text" class="form-control" id="buscador" placeholder="Buscar producto...">
  </div>

  <!-- TABLA -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover text-center" id="tablaCategorias">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Descripción</th>
            <th>Codigo</th>
            <th>Foto</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>

        <?php
  require_once "../modelo/conexion.php";

  $sql = "SELECT * FROM producto WHERE estado = 1";
  $resultado = $conexion->query($sql);
  $contador = 1;

  if ($resultado && $resultado->num_rows > 0) {
      while ($fila = $resultado->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $contador++ . "</td>";
          echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
          echo "<td>" . htmlspecialchars($fila['precio']) . "</td>";
          echo "<td>" . htmlspecialchars($fila['stock']) . "</td>";
          echo "<td>" . htmlspecialchars($fila['descripcion']) . "</td>";
          echo "<td>" . htmlspecialchars($fila['codigo_prod']) . "</td>";
          if (!empty($fila['foto'])) {
            echo "<td><img src='../imagenes/" . htmlspecialchars($fila['foto']) . "' width='60' height='60' class='img-thumbnail'></td>";
          } else {
            echo '<td><span class="text-muted">Sin imagen</span></td>';
          }
          /*
          echo '<td><button class="btn btn-success btn-sm btn-actualizar" data-id="' . $fila['id'] . '"><i class="fas fa-rotate"></i></button></td>';
          */
          echo '<td>
                  <button 
                      class="btn btn-success btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#modalActualizarProducto"
                      onclick=\'cargarDatosProducto(' . json_encode([
                          "id" => $fila['id'],
                          "nombre" => $fila['nombre'],
                          "precio" => $fila['precio'],
                          "stock" => $fila['stock'],
                          "descripcion" => $fila['descripcion'],
                          "codigo_prod" => $fila['codigo_prod'],
                          "id_proveedor" => $fila['id_proveedor'],
                          "id_categoria" => $fila['id_categoria']
                      ]) . ')\'>
                      <i class="fas fa-rotate"></i>
                  </button>
                </td>';

          echo '<td><button class="btn btn-danger btn-sm btn-eliminar" data-id="' . $fila['id'] . '"><i class="fas fa-trash"></i></button></td>';

          echo "</tr>";
      }
  } else {
      echo "<tr><td colspan='6'>No se encontraron producto.</td></tr>";
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




<!-- Modal de Actualización de Producto -->
<div class="modal fade" id="modalActualizarProducto" tabindex="-1" aria-labelledby="modalActualizarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../controlador/ProductoController.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="modalActualizarLabel">Actualizar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id_producto" id="editar_id_producto">

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Nombre</label>
              <input type="text" class="form-control" name="nombre" id="editar_nombre" required>
            </div>
            <div class="col-md-3">
              <label class="form-label fw-bold">Precio</label>
              <input type="number" class="form-control" name="precio" id="editar_precio" required>
            </div>
            <div class="col-md-3">
              <label class="form-label fw-bold">Stock</label>
              <input type="number" class="form-control" name="stock" id="editar_stock">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Descripción</label>
              <input type="text" class="form-control" name="descripcion" id="editar_descripcion">
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold">Código Producto</label>
              <input type="text" class="form-control" name="codigo_prod" id="editar_codigo_prod">
            </div>
          </div>

          <!-- <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Proveedor</label>
              <select class="form-select" name="id_proveedor" id="editar_id_proveedor" required>
                <option value="">Selecciona un proveedor</option>
               
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold">Categoría</label>
              <select class="form-select" name="id_categoria" id="editar_id_categoria" required>
                <option value="">Selecciona una categoría</option>
                
              </select>
            </div>
          </div> -->

          <div class="mb-3">
            <label class="form-label fw-bold">Foto del producto</label>
            <input type="file" class="form-control" name="foto" accept="image/*">
            <small class="form-text text-muted">Formatos permitidos: JPG, PNG.</small>
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
<div class="modal fade" id="modalEliminarProducto" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../controlador/ProductoController.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEliminarLabel">¿Eliminar Producto?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_producto" id="eliminar_id_producto">
          <p>¿Estás seguro de que deseas eliminar este producto?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name="accion" value="eliminar" class="btn btn-danger">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>





<!-- Modal para ver imagen en grande -->
<div class="modal fade" id="modalVerImagen" tabindex="-1" aria-labelledby="modalVerImagenLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark">
      <div class="modal-body text-center">
        <img id="imagenGrande" src="" class="img-fluid rounded" style="max-height: 80vh;" alt="Imagen producto">
      </div>
    </div>
  </div>
</div>

<script>
  // Abrir imagen en modal
  document.querySelectorAll("img.img-thumbnail").forEach(img => {
    img.addEventListener("click", function () {
      const src = this.getAttribute("src");
      document.getElementById("imagenGrande").setAttribute("src", src);
      new bootstrap.Modal(document.getElementById('modalVerImagen')).show();
    });
  });
</script>



<script>
function cargarDatosProducto(producto) {
  document.getElementById('editar_id_producto').value = producto.id;
  document.getElementById('editar_nombre').value = producto.nombre;
  document.getElementById('editar_precio').value = producto.precio;
  document.getElementById('editar_stock').value = producto.stock;
  document.getElementById('editar_descripcion').value = producto.descripcion;
  document.getElementById('editar_codigo_prod').value = producto.codigo_prod;
  document.getElementById('editar_id_proveedor').value = producto.id_proveedor;
  document.getElementById('editar_id_categoria').value = producto.id_categoria;
}
</script>

<script>
  // Mostrar modal con datos al hacer clic en eliminar
  document.querySelectorAll(".btn-eliminar").forEach(btn => {
    btn.addEventListener("click", function () {
      const id = this.dataset.id;
      document.getElementById("eliminar_id_producto").value = id;

      const modalEliminar = new bootstrap.Modal(document.getElementById('modalEliminarProducto'));
      modalEliminar.show();
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