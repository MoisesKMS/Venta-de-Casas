<?php
    require 'includes/app.php';  
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Imagen Nosotros">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>
                    25 años de Experiencia
                </blockquote>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex a sed eius consectetur repudiandae vero officia rem ab, possimus commodi neque quos sunt, labore ut necessitatibus reiciendis doloremque ea veritatis! Lorem ipsum dolor, sit
                    amet consectetur adipisicing elit. Tempora ea voluptatum commodi mollitia dicta maiores dolores recusandae tempore similique officiis? Quisquam maxime omnis aut nostrum in ea ullam fuga ex.</p>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur et sit doloremque ab! Laudantium, molestiae tempore autem nobis, cumque modi alias ullam, minus labore eum sapiente. Eligendi provident molestias officia.</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid ullam quam amet ut tenetur blanditiis impedit nemo voluptatem numquam nobis laboriosam ea pariatur, tempora quia repellendus minima sint minus illo?</p>
            </div>
            <!--.Icono-->
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid ullam quam amet ut tenetur blanditiis impedit nemo voluptatem numquam nobis laboriosam ea pariatur, tempora quia repellendus minima sint minus illo?</p>
            </div>
            <!--.Icono-->
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid ullam quam amet ut tenetur blanditiis impedit nemo voluptatem numquam nobis laboriosam ea pariatur, tempora quia repellendus minima sint minus illo?</p>
            </div>
            <!--.Icono-->
        </div>
    </section>

<?php incluirTemplate('footer'); ?>