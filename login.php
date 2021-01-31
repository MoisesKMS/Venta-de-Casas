<?php
    require 'includes/config/database.php';
    $db = conectarDB();

    $errores = [];

    //autenticar el usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //Permite iniciar una cadena de instruciones sin tener que venir de otro formulario
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email){
            $errores[] = 'El E-Mail es obligatorio o no es valido';
        }
        if(!$password){
            $errores[] = 'El password es obligatorio';
        }

        if(empty($errores)){
            //revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '${email}'";
            $resultado = mysqli_query($db, $query);

            if($resultado->num_rows){
                //Revisar si el passowrd es correto
                $usuario = mysqli_fetch_assoc($resultado);

                //Verificar si el passowrd es correcto o No
                $auth = password_verify($password, $usuario['password']);
                
                if($auth){
                    //El usuario es correcto
                    session_start();
                    //Llenar el arreglod e la sesion
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;
                }else{
                    $errores[] = "El password es incorrecto";
                }
            }else{
                $errores[] = "El Usuario no Existe";
            }
        }

    }


    //Incluye el header
    require 'includes/funciones.php';  
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>
        <?php foreach($errores as $error) :?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST">
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

<?php incluirTemplate('footer'); ?>