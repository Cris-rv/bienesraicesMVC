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
            $mail->Username = '8f73b5001@smtp-brevo.com';
            $mail->Password = 'xsmtpsib-16e75e70a91571025bec80450ba09cdcce0bbc08880f2e73c3778c5d0a60bb0f-HnmrbtNOskBM1y8Z';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Configurar el contenido del mail
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';


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