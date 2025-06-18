<?php
session_start();


if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["password"])) {
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        // Utilizar consultas preparadas para prevenir inyecciones SQL
        $stmt = $conexion->prepare("SELECT id, nombre, apellido FROM usuario WHERE user=? AND password=? LIMIT 1");
        $stmt->bind_param("ss", $usuario, $password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $nombre, $apellido);
            $stmt->fetch();

            // Iniciar sesión
            $_SESSION["id"] = $id;
            $_SESSION["nombre"] = $nombre;
            $_SESSION["apellido"] = $apellido;

            // Redirigir a la página de inicio
            header("location: Dashboard/index.php");
           
            exit(); // Importante para evitar ejecución adicional después de la redirección
        } else {
            // Datos incorrectos
            echo "<div class='alert alert-danger' role='alert'>
                    <h4 class='alert-heading'>Acceso Denegado</h4>
                    <p>Lo siento, no tienes permisos para acceder a esta página.</p>
                    <hr>
                    <p class='mb-0'>Por favor, contacta al administrador del sistema para obtener ayuda.</p>
                  </div>";
        }

        // Cerrar la consulta preparada
        $stmt->close();
    } else {
        // Campos vacíos
        echo "Campos vacíos";
    }
}



?>
