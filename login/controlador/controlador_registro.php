<?php
include '../modelo/conexion.php'; // Asegúrate de que $conexion sea válido

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        !empty($_POST["nombre"]) &&
        !empty($_POST["apellido"]) &&
        !empty($_POST["correo"]) &&
        !empty($_POST["password"])
    ) {
        $nombre = trim($_POST["nombre"]);
        $apellido = trim($_POST["apellido"]);
        $correo = trim($_POST["correo"]);
        $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);

        // Verificar si ya existe el correo
        $stmt = $conexion->prepare("SELECT id FROM usuario WHERE correo = ?");
        if (!$stmt) {
            die("Error en prepare (verificar nombre de columna 'correo'): " . $conexion->error);
        }

        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('El correo ya está registrado'); window.history.back();</script>";
        } else {
            // Insertar nuevo usuario
            $stmt = $conexion->prepare("INSERT INTO usuario (nombre, apellido, correo, password) VALUES (?, ?, ?, ?)");
            if (!$stmt) {
                die("Error en prepare (insert): " . $conexion->error);
            }

            $stmt->bind_param("ssss", $nombre, $apellido, $correo, $password);
            if ($stmt->execute()) {
                echo "<script>alert('Usuario registrado correctamente'); window.location='../index.php';</script>";
            } else {
                echo "<script>alert('Error al registrar usuario'); window.history.back();</script>";
            }
        }

        $stmt->close();
        $conexion->close();
    } else {
        echo "<script>alert('Todos los campos son obligatorios'); window.history.back();</script>";
    }
}
?>
