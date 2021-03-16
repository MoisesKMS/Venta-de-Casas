<?php

use App\Propiedad;

require '../../includes/app.php';
    
estaAutenticado();

    //Validar que sea un ID Valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }

    // Obtener los datos de la Propiedad
    $propiedad = Propiedad::find($id);

    //Consultar vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    //Arreglo con mensajes de errores
    $errores = [];

    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        
        
        //Asignar los atributos
        $args = $_POST['propiedad'];
        
        
        $propiedad->sincronizar($args);

        debuguear($propiedad);

        //Asignar Files a una variable
        $imagen = $_FILES['imagen'];

        
        if(!$titulo){
            $errores[] = "Debes Añadir un Titulo";
        }

        if(!$precio){
            $errores[] = "El Precio es Obligatorio";
        }

        if(strlen($descripcion)<50){
            $errores[] = "La Descripcion es Obligatoria y debe tener al menos 50 Caracteres";
        }

        if(!$habitaciones){
            $errores[] = "El Numero de habitaciones es Obligatorio";
        }

        if(!$wc){
            $errores[] = "El Numero de baños es Obligatorio";
        }

        if(!$estacionamiento){
            $errores[] = "El Numero de estacionamieto es Obligatorio";
        }

        if(!$vendedorId){
            $errores[] = "Elije un Vendedor";
        }

        //Validar que la imagen no pase los 100kb

        $medida = 1000 * 1000;

        if($imagen['size'] > $medida){
            $errores[] = "La imagen es muy pesada";
        }

        if(empty($errores)){
            /* Subiada de Archivos */
            //Crear Carpeta
           $carpetaImagenes = '../../imagenes/';

           if(!is_dir($carpetaImagenes)){
               mkdir($carpetaImagenes);
           }

           $nombreImagen = '';
            
            if($imagen['name']){
                //Eliminar imagen previa
                unlink($carpetaImagenes . $propiedad['imagen']);

                //Generar nombre Unico
                $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

                //Subir la Imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            }else{
                $nombreImagen = $propiedad['imagen'];
            }

            //Insertar en la Base de Datos
            $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, estacionamiento  = ${estacionamiento},  vendedorId = ${vendedorId} WHERE id = ${id};";

            //echo $query;
            
            $resultado = mysqli_query($db, $query);

            if($resultado){
                //Redirecionar
                header('Location: /admin?resultado=2');

            }
        }

    }


    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            
        <?php include '../../includes/templates/formulario_prpiedades.php'; ?>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>