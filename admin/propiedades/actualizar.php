<?php
    require '../../includes/funciones.php'; 
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: ../../login.php');
   }

    //Validar que sea un ID Valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }

    //Base de Datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Obtener los datos de la Propiedad
    $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);



    //Consultar vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    //Arreglo con mensajes de errores
    $errores = [];

    //variables 
    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorId = $propiedad['vendedorId'];
    $imagenPropiedad = $propiedad['imagen'];

    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']) ;
        $precio = mysqli_real_escape_string($db, $_POST['precio']) ;
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']) ;
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']) ;
        $wc = mysqli_real_escape_string($db, $_POST['wc']) ;
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']) ;
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']) ;

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
            <fieldset>
                <legend>Informacion General</legend>
                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo de la Propiedad" value="<?php echo $titulo ?>">

                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" placeholder="Precio de la Propiedad" value="<?php echo $precio ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">

                <img src="/imagenes/<?php echo $imagenPropiedad; ?>" alt="Imagen <?php echo $propiedad['titulo'] ?>" class="imagen-small">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" ><?php echo $descripcion ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion de la Propiedad</legend>
                
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones ?>">

                <label for="wc">Baños:</label>
                <input type="number" name="wc" id="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="">-- Elige un Vendedor --</option>
                    <?php while( $vendedor = mysqli_fetch_assoc($resultado) ):?>
                        <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id'] ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido'] ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>