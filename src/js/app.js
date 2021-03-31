document.addEventListener('DOMContentLoaded', function() {

    eventListeners();
    darkMode();
});

function darkMode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    let optionMode;
    if (localStorage.getItem('modoOscuro') == null) {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
            localStorage.setItem('modoOscuro', true);
        } else {
            document.body.classList.remove('dark-mode');
            localStorage.setItem('modoOscuro', false);
        }

    } else {
        optionMode = localStorage.getItem('modoOscuro');

        if (optionMode === 'true') {
            optionMode = true;
            document.body.classList.add('dark-mode');
        } else if (optionMode === 'false') {
            optionMode = false;
            document.body.classList.remove('dark-mode');
        }
    }

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        optionMode = localStorage.getItem('modoOscuro');
        if (optionMode === 'true') {
            optionMode = false;
        } else if (optionMode === 'false') {
            optionMode = true;
        }
        localStorage.setItem('modoOscuro', optionMode);
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

    //Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMestodosContacto));
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}

function mostrarMestodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');
    if (e.target.value == 'telefono') {
        contactoDiv.innerHTML = `
            <input type="tel" id="telefono" placeholder="Tu Telefono" name="contacto[telefono]">

            <p>Elija la fecha y la hora para la llamada</p>

            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
            <input type="email" id="email" placeholder="Tu email" name="contacto[email]" required>
        `;
    }
}