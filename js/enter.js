/*Enter JS*/
document.getElementById('loginForm').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Evita cualquier comportamiento predeterminado
        this.submit(); // Envía el formulario
    }
});