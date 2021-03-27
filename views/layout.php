<?php
    
    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;
    
    if(!isset($inicio)){
        $inicio = false;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="../build/css/app.css">
    
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono Menu Responsive">
                </div>

                <div class="derecha">
                    <nav class="navegacion">
                        <a href="../nosotros.php">Nosotros</a>
                        <a href="../anuncios.php">Anuncios</a>
                        <a href="../blog.php">Blog</a>
                        <a href="../contacto.php">Contacto</a>
                        <?php if($auth){ ?>
                            <a href="../admin/index.php">Panel de Control</a>
                            <a href="../cerrar-sesion.php">Cerrar Sesion</a>
                        <?php }
                        else{ ?>
                            <a href="login.php">Iniciar Sesion</a>
                        <?php }?>
                        <img src="/build/img/dark-mode.svg" alt="Modo Dark" class="dark-mode-boton">
                    </nav>
                </div>
            </div>
            <!--.barra-->
            <?php
            if($inicio){
                echo "<h1>Venda de Casas y Departamentos Exclusivos de Lujo</h1>";
            }
            ?>
        </div>
    </header>

 <?php echo $contenido; ?>   

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos reservados <?php echo date('Y');?> &copy;</p>
    </footer>

    <script src="../build/js/bundle.min.js"></script>
</body>

</html>