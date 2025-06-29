<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sistema de Inventario</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bootstrap/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="dasboard.css">
  <link rel="shortcut icon" href="../img/logotipoMinired.JPG" type="image/x-icon">
</head>
<body>


<div class="sidebar d-flex flex-column">
  <?php require("./partials/nav.php") ?>
</div>

<div class="content">
    <div class="d-flex justify-content-between align-items-center px-4 py-3"style="background-color: #343a40; color: white;">
    <div>
      <h4 class="mb-0">Perfil</h4>
    </div>
    <?php require("./partials/topbar.php") ?>
  </div>
</div>
  <br>

<div class="container mt-4">
  <div class="row">
    <!-- Perfil Izquierda -->
    <div class="col-md-4 mb-4">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <img src="https://i.imgur.com/2zA4s1t.png" alt="Avatar" class="rounded-circle mb-2" width="100">
          <h5 class="card-title">Emerson Abel Yauri Tapara</h5>
          <p class="text-muted">SL75599888@idat.pe</p>
          <p class="text-muted">SL75599888</p>
          <hr>
          <p><strong>Programa de estudios:</strong><br> Desarrollo de Sistemas de Información</p>
          <p><strong>Campus:</strong><br> San Juan de Lurigancho</p>
          <p><strong>Periodo académico:</strong><br> Cuarto Periodo Académico</p>
        </div>
      </div>
    </div>

    <!-- Datos Personales Derecha -->
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-body">
          <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
              <a class="nav-link active" href="#">Datos personales</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-muted" href="#">Contacto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-muted" href="#">Documentación</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-muted" href="#">Contraseña</a>
            </li>
          </ul>

          <p><strong>Nombres completos:</strong><br> Emerson Abel Yauri Tapara</p>
          <p><strong>Sexo:</strong><br> Hombre</p>
          <p><strong>DNI:</strong><br> 75599888</p>
          <p><strong>Fecha de nacimiento:</strong><br> 30/09/2001</p>

          <div class="alert alert-info mt-4">
            <i class="fas fa-info-circle me-2"></i>
            Si los datos que proporcionaste no son correctos, por favor, ponte en contacto con nuestra central telefónica llamando al #, opción 2 o vía WhatsApp al 
            <a href="https://wa.me/51919498300" target="_blank">919 498 300</a>. También puedes corregirlos a través del trámite 
            <strong>"Modificación o actualización de datos personales"</strong>. Haz clic 
            <a href="#" class="alert-link">aquí</a>.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Scripts -->
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
  document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(link => {
    link.addEventListener("click", function () {
      const icon = this.querySelector(".rotate-icon");
      icon.classList.toggle("open");
    });
  });

  // Vista previa al seleccionar imagen
  document.getElementById("inputFoto").addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById("previewFoto").src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
</script>

</body>
</html>
