<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $inicio = true;
        
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
            //debuguear($respuestas);

            //Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            //configurar SMTP (protocolo de envio de emails)
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'f6925e4079a195';
            $mail->Password = 'c26d0623ecbee4';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configurar el contenido del Email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            
            
            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<h1>Un nuevo cliente ha enviado una solicitud para ' . $respuestas['tipo'] . 'r una Casa, estos son sus datos:</h1>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            $contenido .= '<p>El cliente desea ser contactado por: ' . $respuestas['contacto'] . '</p>';

            //Enviar de forma condicional los campos email y telefono

            if($respuestas['contacto'] == 'telefono'){
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>El cliente espera ser contactado el : ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>El cliente espera ser contactado a las: ' . $respuestas['hora'] . ' horas' . '</p>';

            } else {
                //Email
                $contenido .= '<p>Correo Electronico: ' . $respuestas['email'] . '</p>';
            }
           
            
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Tipo de operacion: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio/Presupuesto: $' . $respuestas['precio'] . '</p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Texto alternativo';

            //Enviar el Email
            if($mail->send()){
                $mensaje = "El mensaje se envio correctamente";
            }else{
                $mensaje = "El mensaje no se pudo enviar";
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}