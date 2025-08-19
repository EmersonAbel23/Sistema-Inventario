<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Venta con Comprobante</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

  <h3>Nueva Venta</h3>
  <form id="formVenta">
    <div class="mb-3">
      <label>Cliente:</label>
      <input type="text" class="form-control" id="cliente" required>
    </div>
    <div class="mb-3">
      <label>Producto:</label>
      <input type="text" class="form-control" id="producto" required>
    </div>
    <div class="mb-3">
      <label>Cantidad:</label>
      <input type="number" class="form-control" id="cantidad" required>
    </div>
    <div class="mb-3">
      <label>Precio Unitario (S/):</label>
      <input type="number" step="0.01" class="form-control" id="precio" required>
    </div>

    <button type="button" class="btn btn-primary" onclick="generarComprobante()">Generar Comprobante</button>
  </form>

  <!-- Comprobante oculto -->
  <div id="comprobanteVenta" style="display:none; margin-top:30px; border:1px solid #ccc; padding:20px;">
    <h4>Comprobante de Pago</h4>
    <p><b>Cliente:</b> <span id="cCliente"></span></p>
    <p><b>Fecha:</b> <span id="cFecha"></span></p>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td id="cProducto"></td>
          <td id="cCantidad"></td>
          <td id="cPrecio"></td>
          <td id="cSubtotal"></td>
        </tr>
      </tbody>
    </table>
    <h5>Total: S/ <span id="cTotal"></span></h5>

    <button onclick="imprimirComprobante()" class="btn btn-success btn-sm mt-3">
      <i class="fa-solid fa-print"></i> Imprimir
    </button>
  </div>

<script>
function generarComprobante() {
  // Tomar datos del formulario
  let cliente = document.getElementById("cliente").value;
  let producto = document.getElementById("producto").value;
  let cantidad = parseInt(document.getElementById("cantidad").value);
  let precio = parseFloat(document.getElementById("precio").value);
  let subtotal = cantidad * precio;

  // Colocar en el comprobante
  document.getElementById("cCliente").textContent = cliente;
  document.getElementById("cProducto").textContent = producto;
  document.getElementById("cCantidad").textContent = cantidad;
  document.getElementById("cPrecio").textContent = "S/ " + precio.toFixed(2);
  document.getElementById("cSubtotal").textContent = "S/ " + subtotal.toFixed(2);
  document.getElementById("cTotal").textContent = subtotal.toFixed(2);

  // Fecha actual
  let hoy = new Date();
  let fecha = hoy.toLocaleDateString() + " " + hoy.toLocaleTimeString();
  document.getElementById("cFecha").textContent = fecha;

  // Mostrar comprobante
  document.getElementById("comprobanteVenta").style.display = "block";
}

function imprimirComprobante() {
  let contenido = document.getElementById("comprobanteVenta").innerHTML;
  let ventana = window.open("", "", "width=800,height=600");
  ventana.document.write("<html><head><title>Comprobante</title>");
  ventana.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">');
  ventana.document.write("</head><body>");
  ventana.document.write(contenido);
  ventana.document.write("</body></html>");
  ventana.document.close();
  ventana.print();
}
</script>

<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</body>
</html>
