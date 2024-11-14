<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Asegúrate de que PHPMailer esté instalado
// Configuración de la base de datos
$dsn = 'mysql:host=db;dbname=correos;charset=utf8';
$username = 'root';
$password = 'root';

try {
    // Conectar a la base de datos usando PDO
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener correos de la base de datos
    $stmt = $conn->query("SELECT email FROM users");
    $emails = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if ($emails) {
        // Crear una instancia de PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor
            $mail->isSMTP();
            $mail->Host = 'mailhog'; // Nombre del servicio de MailHog
            $mail->Port = 1025;

            // Remitente
            $mail->setFrom('manolo@example.com', 'Mailer');

            // Enviar correos a cada dirección
            foreach ($emails as $email) {
                $mail->addAddress($email); // Añadir destinatario

                // Contenido del correo
                $mail->isHTML(true);
                $mail->Subject = 'Prueba de envío de correo';
                $mail->Body    = 'Este es un correo de prueba enviado a ' . $email;
                $mail->AltBody = 'Este es un correo de prueba enviado a ' . $email;

                // Enviar el correo
                $mail->send();
                echo 'Correo enviado a: ' . $email . '<br>';

                // Limpiar destinatarios para el siguiente envío
                $mail->clearAddresses();
            }
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "No se encontraron correos en la base de datos.";
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
