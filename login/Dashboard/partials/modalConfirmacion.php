<?php
session_start();

$mostrarModal = !isset($_SESSION['autorizado_admin']) || $_SESSION['autorizado_admin'] === false;
$credencialesIncorrectas = isset($_SESSION['autorizado_admin']) && $_SESSION['autorizado_admin'] === false;
unset($_SESSION['autorizado_admin']);
?>
<!-- Modal de Confirmación de Administrador -->
<div class="modal fade" id="modalAdminCredenciales" tabindex="-1" aria-labelledby="modalAdminLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../controlador/verificar_admin.php" method="POST" id="formVerificarAdmin">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="modalAdminLabel">Verificación de Administrador</h5>
        </div>
        <div class="modal-body">
          <?php if ($credencialesIncorrectas): ?>
            <div class="alert alert-danger text-center">Credenciales incorrectas. Intente nuevamente.</div>
          <?php endif; ?>

          <div class="mb-3">
            <label for="adminUser" class="form-label">Usuario</label>
            <input type="text" name="admin_user" id="adminUser" class="form-control" placeholder="admin" required>
          </div>

          <div class="mb-3">
            <label for="adminPass" class="form-label">Contraseña</label>
            <input type="password" name="admin_pass" id="adminPass" class="form-control" placeholder="********" required>
          </div>

          <input type="hidden" name="accion" value="verificar_admin">
        </div>
        <div class="modal-footer">
          <a href="index.php" class="btn btn-secondary">Cancelar</a>
          <button type="submit" class="btn btn-primary">Verificar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php if ($mostrarModal): ?>
  <script>
    window.addEventListener("DOMContentLoaded", function () {
      const modal = new bootstrap.Modal(document.getElementById("modalAdminCredenciales"));
      modal.show();
    });
  </script>
<?php endif; ?>