<?php

use App\Propiedad;
use App\Vendedor;

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

    //Consulta par avendedores
    $vendedores = Vendedor::all();

    //Arreglo con mensajes de errores
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