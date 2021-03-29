<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;

class PropiedadController{
    public static function index(Router $router){
        
        $propiedades = Propiedad::all();
        
        //Muetra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;
        
        
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router){
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

           //Arreglo con mensajes de errores
           $errores = Propiedad::getErrores();

        
           if($_SERVER['REQUEST_METHOD'] === 'POST'){
               $propiedad = new Propiedad($_POST['propiedad']);
               /* Subiada de Archivos */
       
               //Asignar Files a una variable
               $imagen = $_FILES['propiedad']['tmp_name']['imagen'];
               
               //Generar nombre Unico
               $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
       
               // setear la imagen
               //Realiza un rezise a la imagen
               if($_FILES['propiedad']['tmp_name']['imagen']){
                   //$image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
                   $propiedad->setImagen($nombreImagen);
               }
               
               //Validar
               $errores = $propiedad->validar();
       
               
               if(empty($errores)){
                   
                   //Crear la carpeta para subir imagenes
                   if(!is_dir(CARPETA_IMAGENES)){
                       mkdir(CARPETA_IMAGENES);
                   }
       
                   //Guarda la Imagen en elservidor
                   //$image->save(CARPETA_IMAGENES . $nombreImagen);
                   move_uploaded_file($imagen, CARPETA_IMAGENES . $nombreImagen);
       
                   //Guarda en la base de datos 
                   $propiedad->guardar();
               }
           }
        
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        //Ejecutar el codigo despues de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Asignar los atributos
            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);

            //Validacion
            $errores = $propiedad->validar();

            //Subida de archivos
            $imagen = $_FILES['propiedad']['tmp_name']['imagen'];

            //Generar nombre Unico
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

            if($_FILES['propiedad']['tmp_name']['imagen']){
                //$image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            if(empty($errores)){
                // Almacenar imagen
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    move_uploaded_file($imagen, CARPETA_IMAGENES . $nombreImagen);
                }
                $propiedad->guardar();
            
            }

        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }
}