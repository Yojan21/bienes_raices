<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{

    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $inicio = true; // Para agregar la imagen del header

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router){
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router){
        
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router){
        $id = validarORedireccionar('/propiedades');

        $propiedad = Propiedad::find($id);
        
        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router){
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router){
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router){

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $respuestas = $_POST['contacto'];
            //Crear una instacia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP (Protocolo para envio de Emails)
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '5addb5de89ea09';
            $mail->Password = 'ca8f383142969b';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;
            //$mail->SMTPDebug = 2;

            //Configurar el contenido del Email

            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p> Tienes un nuevo mensaje</p>';
            $contenido .= '<p> Nombre: '. $respuestas['nombre'] .'</p>';
            
            //Enviar de forma condicional algunos campos de email o telefono
            if($respuestas['contacto'] === 'telefono'){
                $contenido .= '<p> Elijió ser contactado por teléfono </p>';
                $contenido .= '<p> Telefono: '. $respuestas['telefono'] .'</p>';
                $contenido .= '<p> Fecha de contacto: '. $respuestas['fecha'] .'</p>';
                $contenido .= '<p> Hora de contacto: '. $respuestas['hora'] .'</p>';
                
            }else{
                $contenido .= '<p> Elijió ser contactado por Email </p>';
                $contenido .= '<p> Email: '. $respuestas['email'] .'</p>';
            }

            $contenido .= '<p> Mensaje: '. $respuestas['mensaje'] .'</p>';
            $contenido .= '<p> Interés: '. $respuestas['tipo'] .'</p>';
            $contenido .= '<p> Precio o Presupuesto: $'. $respuestas['precio'] .'</p>';
            $contenido .= '<p> Preferencia de contacto: '. $respuestas['contacto'] .'</p>';
            
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo';

            if($mail->send()){
                $mensaje = 'Mensaje enviado con exito';
            }else{
                $mensaje = 'Mensaje NO enviado';
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}