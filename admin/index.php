<?php

    //Importar la conexion
    require '../includes/config/database.php';
    $db = conectarDB();
    
    //escribir el query
    $query = "SELECT * FROM propiedades";
    
    //consular la base de datos
    $resultadoConsulta = mysqli_query($db, $query);
    

    //Muetra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    //Incluye un template
    require '../includes/funciones.php';  
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if(intval($resultado) === 1): ?>
            <p class="alerta exito">Anuncio creado Correctamente</p>
        <?php endif ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    </main>
    
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody><!--.Mostrar los resultados-->
        <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
            <tr>
                <td><?php echo $propiedad['id']; ?></td>
                <td><?php echo $propiedad['titulo']; ?></td>
                <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Casa en la Playa" class="imagen-tabla"></td>
                <td>$<?php echo $propiedad['precio']; ?></td>
                <td>
                    <a href="#"class="boton boton-rojo-block">Eliminar</a>
                    <a href="#"class="boton boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

<?php
    //cerrar la conexion
    mysqli_close($db);

    //incluir template
    incluirTemplate('footer'); 
 ?>