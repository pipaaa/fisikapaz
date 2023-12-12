<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Asegúrate de tener la biblioteca PHPMailer instalada

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];
    $ticketType = $_POST['ticketType'];
    $quantity = $_POST['quantity'];
    $eventDate = $_POST['eventDate'];
    $eventTime = $_POST['eventTime'];

    // Generar el número de pedido aleatorio
    $orderNumber = generateOrderNumber();

    // Crear el cuerpo del correo electrónico
    $message = "Nombre: $name\n";
    $message .= "Correo Electrónico: $email\n";
    $message .= "Tipo de Entrada: $ticketType\n";
    $message .= "Cantidad: $quantity\n";
    $message .= "Fecha del Evento: $eventDate\n";
    $message .= "Hora del Evento: $eventTime\n";
    $message .= "Número de Pedido: $orderNumber\n";

    // Configurar PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurar el servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tucorreo@gmail.com'; // Reemplaza con tu dirección de correo
        $mail->Password   = 'tucontrasena'; // Reemplaza con tu contraseña
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Configurar el remitente y el destinatario
        $mail->setFrom('tucorreo@gmail.com', 'Tu Nombre'); // Reemplaza con tu nombre
        $mail->addAddress($email);
        $mail->addAddress('txangu.p@gmail.com'); // Dirección de correo electrónico adicional

        // Configurar el contenido del correo electrónico
        $mail->isHTML(false);
        $mail->Subject = 'Confirmación de Compra - Gabity';
        $mail->Body    = $message;

        // Enviar el correo electrónico
        $mail->send();
    } catch (Exception $e) {
        echo "Error al enviar el correo electrónico: {$mail->ErrorInfo}";
    }

    // Redirigir a una página de confirmación o mostrar un mensaje
    header('Location: confirmacion.php');
    exit;
}

function generateOrderNumber() {
    // Generar un número aleatorio con las especificaciones dadas
    $firstPart = mt_rand(1000, 9999);
    $secondPart = mt_rand(1000, 9999);
    return "$firstPart-$secondPart";
}
?>
