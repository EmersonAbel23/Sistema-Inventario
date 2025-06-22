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
  <br>

  <!-- Contenedor centrado -->
  <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg" style="max-width: 600px; width: 100%;">
      <div class="card-body">
        <h4 class="card-title text-center mb-4">Perfil</h4>

        <div class="text-center mb-4">
          <div style="position: relative; display: inline-block;">
            <!-- Imagen de perfil -->
            <img src="../imagenes/default.png" class="rounded-circle" width="100" height="100" alt="Foto de perfil" id="previewFoto">
            
            <!-- Botón verde "+" -->
            <label for="inputFoto" style="position: absolute; bottom: 0; right: 0; transform: translate(30%, 30%); cursor: pointer;">
              <div class="btn btn-success rounded-circle d-flex justify-content-center align-items-center" style="width: 30px; height: 30px;">
                <i class="fas fa-plus text-white"></i>
              </div>
            </label>

            <!-- Input oculto -->
            <input type="file" id="inputFoto" name="foto" accept="image/*" style="display: none;">
          </div>
        </div>

        <form>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Nombre</label>
              <input type="text" class="form-control" placeholder="Nombre">
            </div>
            <div class="col-md-6">
              <label class="form-label">Apellido</label>
              <input type="text" class="form-control" placeholder="Apellido">
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" placeholder="correo@ejemplo.com">
          </div>

          <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" class="form-control" placeholder="Número de teléfono">
          </div>

          <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" class="form-control" placeholder="Dirección">
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Ciudad</label>
              <input type="text" class="form-control" placeholder="Ciudad">
            </div>
            <div class="col-md-6">
              <label class="form-label">Edad</label>
              <input type="text" class="form-control" placeholder="50">
            </div>
          </div>

          <!-- <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-success">Guardar Perfil</button>
            <button type="reset" class="btn btn-secondary">Cancelar</button>
          </div> -->
        </form>
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
