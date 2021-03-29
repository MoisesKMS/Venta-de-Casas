<fieldset>
    <legend>Informacion del Vendedor</legend>
                
    <label for="nombre">Nombre:</label>
    <input type="text" name="vendedor[nombre]" id="nombre" placeholder="Ej: Abril" value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" name="vendedor[apellido]" id="apellido" placeholder="Ej: Xeder Left" value="<?php echo s($vendedor->apellido); ?>">

</fieldset>

<fieldset>
    <legend>Informacion Adicional</legend>
                
    <label for="telefono">Telefono:</label>
    <input type="tel" name="vendedor[telefono]" id="telefono" placeholder="Ej: 1234567890" value="<?php echo s($vendedor->telefono); ?>">

</fieldset>