<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "../modelo/conexion.php";
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';
require_once '../PHPMailer/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = trim($_POST['correo_recuperar']);

    // Buscar al usuario y su contraseña
    $stmt = $conexion->prepare("SELECT password, nombre FROM usuario WHERE user = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $contrasena = $usuario['password'];
        $nombre = $usuario['nombre'];

        // Enviar correo con la contraseña
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'pruebaspruebanormal@gmail.com'; 
            $mail->Password = 'jvhjirioaslbensb';              
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('pruebaspruebanormal@gmail.com', 'Sistema de Inventario');
            $mail->addAddress($correo);
            $mail->isHTML(true);

            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body = "
                <p>Hola <strong>$nombre</strong>,</p>
                <p>Tu contraseña actual es: <strong>$contrasena</strong></p>
                <p>Te recomendamos cambiarla si no fuiste tú quien solicitó este mensaje.</p>
            ";

            $mail->send();
            // Mostrar mensaje y redireccionar
            echo "<script>
                    alert('✅ Tu contraseña fue enviada correctamente al correo.');
                    window.location.href = '../index.php';
                  </script>";
            exit;
        } catch (Exception $e) {
            echo "<script>
                    alert('❌ Error al enviar el correo: {$mail->ErrorInfo}');
                    window.location.href = '../index.php';
                  </script>";
            exit;
        }
    } else {
        echo "<script>
                alert('❌ El correo ingresado no está registrado.');
                window.location.href = '../index.php';
              </script>";
        exit;
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "<script>
            alert('Acceso no permitido.');
            window.location.href = '../index.php';
          </script>";
    exit;
}