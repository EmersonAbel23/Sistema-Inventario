<?php
require_once "../modelo/conexion.php";
require '../PHPMailer/PHPMailerAutoload.php'; // Asegúrate de que este archivo existe

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = trim($_POST['correo_recuperar']);

    // Verificamos si el correo existe
    $stmt = $conexion->prepare("SELECT id FROM usuario WHERE user = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        // Generar token seguro
        $token = bin2hex(random_bytes(20));

        // Guardarlo en la BD
        $stmtUpdate = $conexion->prepare("UPDATE usuario SET token_recuperacion = ? WHERE user = ?");
        $stmtUpdate->bind_param("ss", $token, $correo);
        $stmtUpdate->execute();

        // Enviar correo
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'tucorreo@gmail.com'; // Tu correo
        $mail->Password = 'tu_contraseña';      // Tu contraseña o clave de app
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('tucorreo@gmail.com', 'Sistema de Inventario');
        $mail->addAddress($correo);
        $mail->isHTML(true);

        $enlace = "http://localhost/Sistema-Inventario/login/restablecer.php?token=" . $token;

        $mail->Subject = 'Recuperación de contraseña';
        $mail->Body    = "Hola, haz clic en el siguiente enlace para restablecer tu contraseña:<br><br>
                          <a href='$enlace'>$enlace</a>";

        if ($mail->send()) {
            echo "Correo enviado correctamente. Revisa tu bandeja de entrada.";
        } else {
            echo "Error al enviar el correo: " . $mail->ErrorInfo;
        }

    } else {
        echo "El correo no está registrado.";
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Acceso no permitido.";
}
