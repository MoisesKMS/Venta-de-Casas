<?php
    require '../includes/app.php';
    estaAutenticado();

    use App\Propiedad;
    use App\Vendedor;

//Implementar un metodo para obtener todas las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    //Muetra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    
    
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            $tipo = $_POST['tipo'];

            if(validarTipoContenido($tipo)){
                if($tipo === 'vendedor'){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }else if($tipo === 'propiedad'){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }   
            }

            /*//Eliminar el Archivo
            $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);
            unlink('../imagenes/' . $propiedad['imagen']);*/
        }
    }

    //Incluye un template
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if(intval($resultado) === 1): ?>
            <p class="alerta exito">Anuncio Creado Correctamente</p>
        <?php elseif(intval($resultado) === 2): ?>
            <p class="alerta exito">Anuncio Actualizado Correctamente</p>
        <?php elseif(intval($resultado) === 3): ?>
            <p class="alerta exito">Anuncio Eliminado Correctamente</p>
        <?php endif ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    </main>

    <h2>Propiedades</h2>
    <table class="propiedades contenedor">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody class="bg-tabla"><!--.Mostrar los resultados-->
        <?php foreach( $propiedades as $propiedad ): ?>
            <tr> 
                <td><?php echo $propiedad->id; ?></td>
                <td class="txt-blanco"><?php echo $propiedad->titulo; ?></td>
                <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Casa en la Playa" class="imagen-tabla"></td>
                <td>$<?php echo $propiedad->precio; ?></td>
                <td>
                    <div class="contener-elemento">
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="../admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>"class="boton boton-amarillo-block">Actualizar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2>vendedores</h2>
    <table class="propiedades contenedor">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody class="bg-tabla"><!--.Mostrar los resultados-->
        <?php foreach( $vendedores as $vendedor ): ?>
            <tr> 
                <td><?php echo $vendedor->id; ?></td>
                <td class="txt-blanco"><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                <td><?php echo $vendedor->telefono; ?></td>
                <td>
                    <div class="contener-elemento">
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="../admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>"class="boton boton-amarillo-block">Actualizar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php

    //incluir template
    incluirTemplate('footer'); 
 ?>