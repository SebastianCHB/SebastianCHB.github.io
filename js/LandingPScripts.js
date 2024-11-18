/*Cambio A Login */
function changeLogin(){
    window.location.href='login.html'
}
/*Cambio a Signup*/
function changeSignup(){
    window.location.href='signup.html'
}
/*Cambio a landing page*/
function changeLandingp(){
    window.location.href='index.html'
}

function changePDA(){
    window.location.href='./PDA/idex.html'
}


// Seleccionamos todos los elementos del menú y secciones
const menuItems = document.querySelectorAll('div div');
const sections = document.querySelectorAll('.content-section');

// Función para activar la sección seleccionada
function activateSection(id) {
    // Ocultar todas las secciones
    sections.forEach(section => section.classList.remove('active'));
    
    // Mostrar la sección que corresponde al id clicado
    document.getElementById(id).classList.add('active');
}

// Remover la clase 'active' de todas las opciones del menú
function deactivateMenu() {
    menuItems.forEach(menu => menu.classList.remove('active'));
}

// Evento para cada opción del menú
document.getElementById('menu-home').addEventListener('click', function() {
    deactivateMenu();
    this.classList.add('active');
    activateSection('home');
});

document.getElementById('menu-features').addEventListener('click', function() {
    deactivateMenu();
    this.classList.add('active');
    activateSection('features');
});

document.getElementById('menu-pricing').addEventListener('click', function() {
    deactivateMenu();
    this.classList.add('active');
    activateSection('pricing');
});

document.getElementById('menu-testimonials').addEventListener('click', function() {
    deactivateMenu();
    this.classList.add('active');
    activateSection('testimonials');
});