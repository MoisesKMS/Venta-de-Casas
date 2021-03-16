<fieldset>
                <legend>Informacion General</legend>
                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo de la Propiedad" value="<?php echo s($propiedad->titulo); ?>">

                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" placeholder="Precio de la Propiedad" value="<?php echo s($propiedad->precio); ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" ><?php echo s($propiedad->descripcion); ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion de la Propiedad</legend>
                
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">

                <label for="wc">Baños:</label>
                <input type="number" name="wc" id="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
            </fieldset>