<?php
    //Base de Datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    //Consultar vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    //Arreglo con mensajes de errores
    $errores = [];

    //variables 
    $titulo = "";
    $precio = "";
    $descripcion = "";
    $habitaciones = "";
    $wc = "";
    $estacionamiento = "";
    $vendedorId = "";
    $creado = date('Y/m/d');

    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $vendedorId = $_POST['vendedor'];

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

        if(empty($errores)){
            //Insertar en la Base de Datos
            $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) VALUES ('${titulo}', '${precio}', '${descripcion}', '${habitaciones}', '${wc}', '${estacionamiento}', '${creado}', '${vendedorId}')";

            //echo $query;
            $resultado = mysqli_query($db, $query);

            if($resultado){
                //Redirecionar
                header('Location: /admin');
            }
        }

    }


    require '../../includes/funciones.php';  
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

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Informacion General</legend>
                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo de la Propiedad" value="<?php echo $titulo ?>">

                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" placeholder="Precio de la Propiedad" value="<?php echo $precio ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">

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

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>