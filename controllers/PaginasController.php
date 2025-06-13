<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {

    public static function index(Router $router ) {

        $propiedades = Propiedad::get(3);
        $inicio = true;
        
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros( Router $router ) {

        $router->render('paginas/nosotros', [

        ]);
    }

    public static function propiedades(Router $router) {
        
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router) {
        
        $id = validarORedireccionar('/propiedades');

        // Buscar propiedad por id
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog( Router $router ) {
        
        $router->render('paginas/blog', [

        ]);
    }

    public static function entrada( Router $router) {
        
        $router->render('paginas/entrada', [

        ]);
    }

    public static function contacto( Router $router ) {

        $mensaje = false;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];
            
            // Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.brevo.com';
            $mail->SMTPAuth = true;
            $mail->Username = getenv('BREVO_SMTP_USER'); // Usa getenv()
            $mail->Password = getenv('BREVO_SMTP_PASSWORD'); // Nunca expones la clave en el código
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Remitente y destinatario desde variables
            $mail->setFrom(getenv('BREVO_SMTP_FROM'), 'Admin Bienes Raíces');
            $mail->addAddress(getenv('BREVO_SMTP_TO')); // Correo donde recibirás los mensajes
            $mail->Subject = 'Nuevo mensaje desde el sitio web';


            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            

            // Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje </p>'; 
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . ' </p>'; 

            // Enviar de forma condicional algunos campos de email o telefono
            if($respuestas['contacto'] === 'telefono') {
                // Mostrar campos relacionados con el telefono
                $contenido .= '<strong> Eligio ser contactado mediante Telefono: </strong>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . ' </p>'; 
                $contenido .= '<p>Fecha Contacto: ' . $respuestas['fecha'] . ' </p>'; 
                $contenido .= '<p>Hora Contacto: ' . $respuestas['hora'] . ' </p>'; 
            } else {
                // Es email, entonces muestra lo siguiente
                $contenido .= '<strong> Eligio ser contactado mediante E-mail: </strong>';
                $contenido .= '<p> E-mail: ' . $respuestas['email'] . ' </p>'; 
            }

            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . ' </p>'; 
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . ' </p>'; 
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alt sin html';

            // Enviar el email
            if($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar";
            }

        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}