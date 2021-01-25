<?php include 'includes/templates/header.php'; ?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al Bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="imagen destacada">
        </picture>

        <div class="resumen-propiedad">
            <div class="precio">$3,000,000</div>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones">
                    <p>4</p>
                </li>
            </ul>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex a sed eius consectetur repudiandae vero officia rem ab, possimus commodi neque quos sunt, labore ut necessitatibus reiciendis doloremque ea veritatis! Lorem ipsum dolor, sit amet
                consectetur adipisicing elit. Tempora ea voluptatum commodi mollitia dicta maiores dolores recusandae tempore similique officiis? Quisquam maxime omnis aut nostrum in ea ullam fuga ex.</p>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur et sit doloremque ab! Laudantium, molestiae tempore autem nobis, cumque modi alias ullam, minus labore eum sapiente. Eligendi provident molestias officia.</p>
        </div>
    </main>

<?php include 'includes/templates/footer.php'; ?>