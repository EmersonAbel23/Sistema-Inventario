<div>
    <div class="sidebar-header">
      SISTEMA DE INVENTARIO MINIRED
    </div>
    <div class="user-info">
      <img src="../imagenes/default.png" alt="Admin" class="img-fluid rounded-circle mb-2" width="80">
      <?php
      if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Solo se ejecuta si la sesión aún no ha iniciado
      }

      $nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario';
      $apellido = isset($_SESSION['apellido']) ? $_SESSION['apellido'] : '';
      ?>
      <div><strong><?php echo $nombre . ' ' . $apellido; ?></strong></div>
      <div style="font-size: 0.8em;">Administrador</div>
    </div>

    <ul class="nav flex-column">
      <li class="nav-item">
        <a href="index.php" class="nav-link"><i class="fas fa-home me-2"></i>Inicio</a>
      </li>

      <!-- CATEGORÍAS -->
      <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#categoriasSubmenu">
          <span><i class="fas fa-tags me-2"></i> Categorías</span>
          <i class="fas fa-chevron-down rotate-icon"></i>
        </a>
        <ul class="collapse list-unstyled submenu" id="categoriasSubmenu">
          <li><a class="nav-link" href="categoria.php">Nueva categoría</a></li>
          <li><a class="nav-link" href="lista_categoria.php">Lista de categorías</a></li>
        </ul>
      </li>

      <!-- SPRINT 2 NUEVOS MENÚS -->
      <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#productosSubmenu">
          <span><i class="fas fa-boxes me-2"></i> Productos</span>
          <i class="fas fa-chevron-down rotate-icon"></i>
        </a>
        <ul class="collapse list-unstyled submenu" id="productosSubmenu">
          <li><a class="nav-link" href="producto.php">Registrar producto</a></li>
          <li><a class="nav-link" href="lista_producto.php">Lista de productos</a></li> 
          <li><a class="nav-link" href="producto_categoria.php">Producto por Categoria</a></li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#marcasSubmenu">
          <span><i class="fas fa-trademark me-2"></i> Marcas</span>
          <i class="fas fa-chevron-down rotate-icon"></i>
        </a>
        <ul class="collapse list-unstyled submenu" id="marcasSubmenu">
          <li><a class="nav-link" href="#">Registrar marca</a></li>
          <li><a class="nav-link" href="#">Lista de marcas</a></li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#proveedoresSubmenu">
          <span><i class="fas fa-truck me-2"></i> Proveedores</span>
          <i class="fas fa-chevron-down rotate-icon"></i>
        </a>
        <ul class="collapse list-unstyled submenu" id="proveedoresSubmenu">
          <li><a class="nav-link" href="#">Registrar proveedor</a></li>
          <li><a class="nav-link" href="#">Lista de proveedores</a></li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#rubrosSubmenu">
          <span><i class="fas fa-layer-group me-2"></i> Rubros</span>
          <i class="fas fa-chevron-down rotate-icon"></i>
        </a>
        <ul class="collapse list-unstyled submenu" id="rubrosSubmenu">
          <li><a class="nav-link" href="#">Registrar rubro</a></li>
          <li><a class="nav-link" href="#">Lista de rubros</a></li>
        </ul>
      </li>

        <!-- Usuario -->
        <li class="nav-item">
          <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#usuarioSubmenu">
            <span><i class="fas fa-user me-2"></i> Usuario</span>
            <i class="fas fa-chevron-down rotate-icon"></i>
          </a>
          <ul class="collapse list-unstyled submenu" id="usuarioSubmenu">
            <li><a class="nav-link" href="lista_usuario.php">Lista de usuarios</a></li>
          </ul>
        </li>


      <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#entradasSubmenu">
          <span><i class="fas fa-arrow-down me-2"></i> Entradas</span>
          <i class="fas fa-chevron-down rotate-icon"></i>
        </a>
        <ul class="collapse list-unstyled submenu" id="entradasSubmenu">
          <li><a class="nav-link" href="#">Registrar entrada</a></li>
          <li><a class="nav-link" href="#">Historial de entradas</a></li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#salidasSubmenu">
          <span><i class="fas fa-arrow-up me-2"></i> Salidas</span>
          <i class="fas fa-chevron-down rotate-icon"></i>
        </a>
        <ul class="collapse list-unstyled submenu" id="salidasSubmenu">
          <li><a class="nav-link" href="#">Registrar salida</a></li>
          <li><a class="nav-link" href="#">Historial de salidas</a></li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link"><i class="fas fa-screwdriver-wrench me-2"></i> Configuración</a>
      </li>

    </ul>
  </div>

  <!-- Cerrar sesión -->
  <div class="mt-auto p-3">
    <a href="../controlador/controlador_cerrar.php" class="btn btn-outline-danger w-100">
      <i class="fas fa-power-off me-2"></i> Cerrar sesión
    </a>
  </div>