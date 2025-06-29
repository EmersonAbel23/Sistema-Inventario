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
          <img src="../imagenes/default.png" alt="Avatar" class="rounded-circle mb-2" width="100">
           <?php
              if (session_status() === PHP_SESSION_NONE) {
            session_start(); 
              }
            $nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario';
            $apellido = isset($_SESSION['apellido']) ? $_SESSION['apellido'] : '';
            $correo = isset($_SESSION['user']) ? $_SESSION['user'] : '';
            ?>
          <h5 class="card-title"> <?php echo $nombre . ' ' . $apellido; ?></h5>
          <p class="text-muted"><?php echo $correo; ?></p>
          <p class="text-muted">Administrador</p>
          <hr>
          <p><strong>Programa de estudios:</strong><br> Desarrollo de Sistemas de Información</p>
          <p><strong>Campus:</strong><br> San Juan de Lurigancho</p>
          <p><strong>Periodo académico:</strong><br> Cuarto Periodo Académico</p>
        </div>
      </div>
    </div>

    <!-- Derecha con pestañas -->
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-body">
          <!-- Tabs -->
          <ul class="nav nav-tabs mb-3" id="tabs">
            <li class="nav-item">
              <a class="nav-link active" data-tab="personal" href="#">Datos personales</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-tab="contacto" href="#">Contacto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-tab="contrasena" href="#">Contraseña</a>
            </li>
          </ul>

          <!-- Contenido: Datos personales -->
          <div id="tab-personal">
            <p><strong>Nombres completos:</strong><br> Emerson Abel Yauri Tapara</p>
            <p><strong>Sexo:</strong><br> Hombre</p>
            <p><strong>DNI:</strong><br> 75599888</p>
            <p><strong>Fecha de nacimiento:</strong><br> 30/09/2001</p>

            <div class="alert alert-info mt-4">
              <i class="fas fa-info-circle me-2"></i>
              Si los datos que proporcionaste no son correctos, ponte en contacto con nuestra central llamando al #, opción 2 o vía WhatsApp 
              <a href="https://wa.me/51919498300" target="_blank">919 498 300</a>. También puedes corregirlos a través del trámite 
              <strong>"Modificación o actualización de datos personales"</strong>. Haz clic <a href="#">aquí</a>.
            </div>
          </div>

          <!-- Contenido: Contacto -->
          <div id="tab-contacto" class="d-none">
            <p><strong>Teléfono personal:</strong><br> 987654321</p>
            <p><strong>Correo institucional:</strong><br> SL75599888@idat.pe</p>
            <p><strong>Correo alternativo:</strong><br> emerson.yauri@gmail.com</p>
            <p><strong>Dirección:</strong><br> Av. Universitaria 1234, Lima, Perú</p>
          </div>

          <!-- Contenido: Contraseña -->
          <div id="tab-contrasena" class="d-none">
            <form>
              <div class="mb-3">
                <label for="actual" class="form-label">Contraseña actual</label>
                <input type="password" class="form-control" id="actual" required>
              </div>
              <div class="mb-3">
                <label for="nueva" class="form-label">Nueva contraseña</label>
                <input type="password" class="form-control" id="nueva" required>
              </div>
              <div class="mb-3">
                <label for="confirmar" class="form-label">Confirmar nueva contraseña</label>
                <input type="password" class="form-control" id="confirmar" required>
              </div>
              <button type="submit" class="btn btn-primary">Actualizar contraseña</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- JS para manejar pestañas -->
<script>
  const tabs = document.querySelectorAll('#tabs .nav-link');
  const contents = {
    personal: document.getElementById('tab-personal'),
    contacto: document.getElementById('tab-contacto'),
    contrasena: document.getElementById('tab-contrasena')
  };

  tabs.forEach(tab => {
    tab.addEventListener('click', e => {
      e.preventDefault();
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      for (const key in contents) {
        contents[key].classList.add('d-none');
      }
      contents[tab.dataset.tab].classList.remove('d-none');
    });
  });
</script>


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
