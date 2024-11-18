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
/*
function changePDA(){
    window.location.href='./PDA/index.html'
}
*/

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


// Función para manejar el login
document.getElementById("loginButton").addEventListener("click", function () {
    var email = document.getElementById("email").value.trim();
    var password = document.getElementById("password").value.trim();

    // Validación de las credenciales de usuario
    var loggedInUser = users.find(
        (user) => user.username === email && user.password === password
    );

    if (loggedInUser) {
        // Si el login es exitoso, redirigir al usuario
        window.location.href = "./index.html"; // Cambia a la página de inicio después de login
    } else {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "User or Password incorrect",
        });
    }
});
window.onload = function() {
    // Revisamos si el usuario ha iniciado sesión (puedes usar localStorage o sesión)
    // Aquí asumimos que si el usuario ha iniciado sesión, deberíamos ocultar los botones
    if (localStorage.getItem("loggedIn") === "true") {
        // Ocultar los botones de login y signup
        document.getElementById("loginButton").style.display = "none";
        document.getElementById("signupButton").style.display = "none";
    }
};
document.getElementById("loginButton").addEventListener("click", function () {
    var email = document.getElementById("email").value.trim();
    var password = document.getElementById("password").value.trim();

    var loggedInUser = users.find(
        (user) => user.username === email && user.password === password
    );

    if (loggedInUser) {
        // Almacenar en localStorage que el usuario ha iniciado sesión
        localStorage.setItem("loggedIn", "true");

        // Redirigir a la landing page (index.html)
        window.location.href = "./index.html"; 
    } else {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "User or Password incorrect",
        });
    }
});
function logout() {
    // Eliminar la clave de loggedIn en localStorage
    localStorage.removeItem("loggedIn");

    // Volver a mostrar los botones de login y signup
    document.getElementById("loginButton").style.display = "block";
    document.getElementById("signupButton").style.display = "block";
}

