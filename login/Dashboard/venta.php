<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sistema de Inventario - Ventas</title>
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
      <h4 class="mb-0">Venta</h4>
    </div>
    <?php require("./partials/topbar.php") ?>
  </div>
</div>
  <!-- ALERTA DE ÉXITO -->
    <?php if (isset($_GET["success"])): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> ¡guardado correctamente!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
      </div>
    <?php endif; ?>


<div class="container mt-5">
  <h3><i class="fa-solid fa-cart-shopping"></i> Registrar Venta</h3>
  <form action="../controlador/VentaController.php" method="POST">
    
    <!-- Botón Modal -->
<div class="d-flex justify-content-end mb-3">
  <button type="button" class="btn btn-primary btn-sm shadow" data-bs-toggle="modal" data-bs-target="#modalComprobante" onclick="mostrarComprobante()">
    <i class="fa-solid fa-file-invoice-dollar"></i> Ver Comprobante
  </button>
</div>

<!-- Modal -->
<div class="modal fade" id="modalComprobante" tabindex="-1" aria-labelledby="modalComprobanteLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg rounded-4 border-0">

      <!-- Encabezado -->
      <div class="modal-header" style="background: linear-gradient(90deg,#007bff,#0056b3); color: white;">
        <h5 class="modal-title d-flex align-items-center" id="modalComprobanteLabel">
          <i class="fa-solid fa-receipt me-2"></i> Comprobante de Pago
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Cuerpo dinámico -->
      <div class="modal-body p-4">
        <div class="mb-3">
          <p><strong>Cliente:</strong> <span id="compCliente"></span></p>
          <p><strong>Fecha:</strong> <span id="compFecha"></span></p>
        </div>

        <table class="table table-hover text-center align-middle">
          <thead class="table-primary">
            <tr>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Precio</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody id="compDetalle"></tbody>
        </table>

        <div class="d-flex justify-content-end">
          <h4 class="fw-bold text-primary">Total: S/ <span id="compTotal">0.00</span></h4>
        </div>
      </div>

      <!-- Pie -->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
          <i class="fa-solid fa-xmark"></i> Cerrar
        </button>
        <button type="button" class="btn btn-success btn-sm" onclick="comprobantePDF()">
          <i class="fa-solid fa-print"></i> Imprimir
        </button>
      </div>
    </div>
  </div>
</div> 


    <!-- Cliente -->
    <div class="mb-3">
      <label class="form-label">Cliente</label>
      <input type="text" name="cliente" class="form-control" required>
    </div>

    <!-- Selección de Producto -->
    <div class="row g-2 mb-3">
      <div class="col-md-6">
        <label class="form-label">Producto</label>
        <select name="id_producto" id="producto" class="form-select" required>
          <option value="">-- Selecciona un producto --</option>
          <?php
          require "../modelo/conexion.php";
          $sql = "SELECT id, nombre, precio FROM producto WHERE stock > 0";
          $resultado = $conexion->query($sql);
          while($row = $resultado->fetch_assoc()){
            echo "<option value='{$row['id']}' data-precio='{$row['precio']}'>
                    {$row['nombre']}
                  </option>";
          }
          ?>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label">Precio Unitario (S/)</label>
        <input type="text" id="precio_unitario" class="form-control" readonly>
      </div>
      <div class="col-md-3">
        <label class="form-label">Cantidad</label>
        <input type="number" id="cantidad" class="form-control" min="1" required>
      </div>
    </div>

    <!-- Botón para agregar -->
    <div class="mb-3">
      <button type="button" class="btn btn-success" id="btnAgregar">
        <i class="fa-solid fa-plus"></i> Agregar Producto
      </button>
    </div>

    <!-- Carrito Temporal -->
    <table class="table table-bordered text-center" id="tablaCarrito">
      <thead class="table-light">
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          <th>Subtotal</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>

    <!-- Total -->
    <h4 class="text-end me-3">Total: S/ <span id="totalVenta">0.00</span></h4>

    <!-- Botón Guardar -->
    <button type="submit" class="btn btn-primary w-100">
      <i class="fa-solid fa-floppy-disk"></i> Guardar Venta
    </button>
    
  </form>
</div>


<script>
let carrito = [];
let total = 0;

// Mostrar precio cuando se selecciona producto
document.getElementById("producto").addEventListener("change", function(){
  let precio = this.options[this.selectedIndex].getAttribute("data-precio");
  document.getElementById("precio_unitario").value = precio ? precio : "";
});

// Agregar producto al carrito
document.getElementById("btnAgregar").addEventListener("click", function(){
  let select = document.getElementById("producto");
  let id = select.value;
  let nombre = select.options[select.selectedIndex].text;
  let precio = parseFloat(select.options[select.selectedIndex].getAttribute("data-precio"));
  let cantidad = parseInt(document.getElementById("cantidad").value);

  if(id && cantidad > 0){
    let subtotal = precio * cantidad;
    carrito.push({id, nombre, cantidad, precio, subtotal});
    actualizarCarrito();
  } else {
    alert("Selecciona un producto y cantidad válida");
  }
});

// Actualizar tabla carrito
function actualizarCarrito(){
  let tbody = document.querySelector("#tablaCarrito tbody");
  tbody.innerHTML = "";
  total = 0;

  carrito.forEach((item, index) => {
    total += item.subtotal;
    tbody.innerHTML += `
      <tr>
        <td><input type="hidden" name="productos[${index}][id]" value="${item.id}">${item.nombre}</td>
        <td><input type="hidden" name="productos[${index}][cantidad]" value="${item.cantidad}">${item.cantidad}</td>
        <td><input type="hidden" name="productos[${index}][precio]" value="${item.precio}">${item.precio.toFixed(2)}</td>
        <td>${item.subtotal.toFixed(2)}</td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarItem(${index})"><i class="fa-solid fa-trash"></i></button></td>
      </tr>
    `;
  });

  document.getElementById("totalVenta").innerText = total.toFixed(2);
}

// Eliminar producto del carrito
function eliminarItem(index){
  carrito.splice(index, 1);
  actualizarCarrito();
}
</script>
<script>
function mostrarComprobante() {
  // Cliente
  let cliente = document.querySelector("input[name='cliente']").value;
  document.getElementById("compCliente").innerText = cliente ? cliente : "No especificado";

  // Fecha actual
  let hoy = new Date();
  let fecha = hoy.toISOString().slice(0,10);
  document.getElementById("compFecha").innerText = fecha;

  // Detalle de productos
  let tbody = document.getElementById("compDetalle");
  tbody.innerHTML = "";
  carrito.forEach(item => {
    tbody.innerHTML += `
      <tr>
        <td>${item.nombre}</td>
        <td>${item.cantidad}</td>
        <td>S/ ${item.precio.toFixed(2)}</td>
        <td>S/ ${item.subtotal.toFixed(2)}</td>
      </tr>
    `;
  });

  // Total
  document.getElementById("compTotal").innerText = total.toFixed(2);
}
</script>


<script>
  async function comprobantePDF() {
    const { jsPDF } = window.jspdf;

    // Tomamos la sección del comprobante
    const comprobante = document.querySelector("#tablaCarrito"); 
    if (!comprobante) {
      alert("Primero genera el comprobante");
      return;
    }

    const canvas = await html2canvas(comprobante, {
      scale: 2,
      backgroundColor: "#ffffff"
    });

    const imgData = canvas.toDataURL("image/png");
    const pdf = new jsPDF("p", "mm", [80, 200]); // tamaño tipo ticket

    // Datos de encabezado del ticket
    pdf.setFontSize(14);
    pdf.setTextColor(40);
    pdf.text("MINIRED", 10, 10);
    pdf.setFontSize(10);
    pdf.text("Ubicación: San Juan de Lurigancho", 10, 16);
    pdf.text("Comprobante de Pago", 10, 22);

    const pageWidth = pdf.internal.pageSize.getWidth();
    const imgProps = pdf.getImageProperties(imgData);
    const imgWidth = pageWidth - 10; // margen
    const imgHeight = (imgProps.height * imgWidth) / imgProps.width;

    pdf.addImage(imgData, "PNG", 5, 28, imgWidth, imgHeight);
    pdf.save("comprobante.pdf");
  }
</script>




<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
