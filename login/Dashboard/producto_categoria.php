<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sistema de Inventario</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bootstrap/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="dasboard.css">
</head>
<body>

<div class="sidebar d-flex flex-column">
  <?php require("./partials/nav.php") ?>
</div>

<div class="content">
  <div class="header-bar">
     Producto / Categoria
  </div>
  <div class="page-content">
    <h3 class="mb-4"><i class="fas fa-box me-2"></i>Producto por Categoria</h3>
    <div class="row mt-4 g-4">


  <!-- BUSCADOR -->
  <div class="mb-3">
    <input type="text" class="form-control" id="buscador" placeholder="Buscar...">
  </div>

 <h3 class="text-muted mb-4 ms-4">Categorías</h3>


<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
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
