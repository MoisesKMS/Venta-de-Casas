<?php
    require '../../includes/app.php';
    
    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;
    
    estaAutenticado();

    //Base de Datos
    $db = conectarDB();

    $propiedad = new Propiedad;

    //Consultar vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();


    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
            

        $propiedad = new Propiedad($_POST);

        /* Subiada de Archivos */

        //Asignar Files a una variable
        $imagen = $_FILES['imagen'];
            
        //Generar nombre Unico
        $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

        // setear la imagen
        //Realiza un rezise a la imagen
        if($_FILES['imagen']['tmp_name']){
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
            move_uploaded_file($imagen['tmp_name'], CARPETA_IMAGENES . $nombreImagen);

            //Guarda en la base de datos 
            $resultado = $propiedad->guardar();

            //Mensaje de Exito o Error
            if($resultado){
                //Redirecionar
                header('Location: /admin?resultado=1');

            }
        }

    }


    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin/" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_prpiedades.php'; ?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>