<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
        
        <?php 
            if($resultado){
                $mensaje = mostrarNotificacion(intval($resultado));
                if($mensaje) { ?>
                <p class="alerta exito"><?php echo s($mensaje); ?></p>
                <?php }
            }
        ?>

        <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo Vendedor</a>


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
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>"class="boton boton-amarillo-block">Actualizar</a>
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
                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="vendedores/actualizar?id=<?php echo $vendedor->id; ?>"class="boton boton-amarillo-block">Actualizar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>