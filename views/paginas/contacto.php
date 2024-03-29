<main class="contenedor seccion contenido-centrado">
    <h1 data-cy="heading-contacto">Contacto</h1>

    <?php  if($mensaje){ ?>
            <p data-cy="alerta-envio-formulario" class='alerta exito'><?php echo $mensaje; ?></p>
    <?php } ?>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen destacada">
    </picture>

    <h2 data-cy="heading-formulario">Llene el Formulario de Contacto</h2>

    <form data-cy="formulario-contacto" class="formulario" method="POST" action="/contacto">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre</label>
            <input data-cy="input-nombre" type="text" id="nombre" placeholder="Tu Nombre" name="contacto[nombre]" required>

            <label for="mensaje">Mensaje</label>
            <textarea data-cy="input-mensaje" id="mensaje" name="contacto[mensaje]" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la Propiedad</legend>

            <label for="opciones">Vende</label>
            <select data-cy="input-opciones" id="opciones" name="contacto[tipo]" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input data-cy="input-precio" type="number" id="presupuesto" placeholder="Tu precio o presupuesto" name="contacto[precio]" required>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Telefono</label>
                <input data-cy="forma-contacto" type="radio" id="contactar-telefono" value="telefono" name="contacto[contacto]" required>

                <label for="contactar-email">E-Mail</label>
                <input data-cy="forma-contacto" type="radio" id="contactar-email" value="email" name="contacto[contacto]" required>
            </div>

            <div id="contacto"></div>

            
        </fieldset>
        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>
