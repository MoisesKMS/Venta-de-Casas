<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>
        <?php foreach($errores as $error) :?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/login">
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
