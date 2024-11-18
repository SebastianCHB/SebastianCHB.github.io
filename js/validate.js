// Usuarios
var users = [
    { username: "admin", password: "admin123", role: "admin" }, // Administrador
    { username: "user", password: "user123", role: "user" },   // Usuario
];

document.getElementById("login-button").addEventListener("click", function () {
    var email = document.getElementById("email").value.trim();
    var password = document.getElementById("password").value.trim();

    // Validar credenciales
    var loggedInUser = users.find(
        (user) => user.username === email && user.password === password
    );

    if (loggedInUser) {
        if (loggedInUser.role === "admin") {
            window.location.href = "./PDA/index.html";
        } else if (loggedInUser.role === "user") {
            window.location.href = "./index.html";
        }
    } else {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "User or Password incorrect",
          });
    }
});
