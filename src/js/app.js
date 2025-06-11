document.addEventListener('DOMContentLoaded', function() {

    eventListeners();

    darkMode();
});

function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    // console.log(prefiereDarkMode);

    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function() {
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    })

    const darkMode = document.querySelector('.dark-mode-btn');

    darkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    const close = document.querySelector('.close');

    mobileMenu.addEventListener('click', navegacionResponsive);
    close.addEventListener('click', cerrarNav);

    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
}

function navegacionResponsive() {
    const oculto = document.querySelector('.oculto');

     if(oculto.classList.contains('mostrar')) {  //Este codigo hace lo mismo que .navegacion.classList.toggle('')
         oculto.classList.remove('mostrar');
     } else {
         oculto.classList.add('mostrar');
     }

     
    // navegacion.classList.toggle('mostrar');
}

function cerrarNav() {
    const oculto = document.querySelector('.oculto');

     if(oculto.classList.contains('mostrar')) {  //Este codigo hace lo mismo que .navegacion.classList.toggle('')
         oculto.classList.remove('mostrar');
     } else {
         oculto.classList.add('mostrar');
     }
}

function mostrarMetodosContacto(e) {
    
    const contactoDiv = document.querySelector('#contacto');

    if(e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Ingrese su número telefonico</label>
            <input type="tel" placeholder="Tu telefono" name="contacto[telefono]" id="telefono" >
            <p>Elija la fecha y la hora para ser contactado</p>

            <label for="fecha">Fecha</label>
            <input type="date" name="contacto[fecha]" id="fecha">

            <label for="hora">Hora</label>
            <input type="time" name="contacto[hora]" id="hora" min="09:00" max="18:00">
        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email">Ingrese su e-mail</label>
            <input type="email" placeholder="Tu email" name="contacto[email]" id="email" required>
        `;
    }
}