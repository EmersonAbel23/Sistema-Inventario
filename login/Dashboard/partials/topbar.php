<div class="d-flex justify-content-between align-items-center px-4 py-3"style="background-color: #343a40; color: white;">
  <div>
    <h5 class="mb-0"></h5>
  </div>
  <div class="dropdown">
    <a class="text-white text-decoration-none dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
      <img src="../imagenes/default.png" alt="Usuario" class="rounded-circle me-2" width="32" height="32">
      <span><?php echo $_SESSION['nombre'] ?? 'Usuario'; ?></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
      <li><a class="dropdown-item" href="userPerfil.php"><i class="fas fa-user me-2"></i>Mi Perfil</a></li>
      <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i>Editar Perfil</a></li>
      <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Configuración</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Desconectar</a></li>
    </ul>
  </div>
</div>
