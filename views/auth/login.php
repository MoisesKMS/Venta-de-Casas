<main class="contenedor seccion contenido-centrado">
        <h1 data-cy="heading-login">Iniciar Sesion</h1>
        <?php foreach($errores as $error) :?>
            <div data-cy="alerta-login" class="alerta error"><?php echo $error; ?></div>
        <?php endforeach; ?>

        <form data-cy="formulario-login" class="formulario" method="POST" action="/login">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Tu email" required>

            <label for="passowrd">Password</label>
            <input type="password" name="password" id="pasword" placeholder="Tu Password" required>
        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
    </main>
