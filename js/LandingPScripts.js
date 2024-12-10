// Seleccionamos los elementos del menú
const menuItems = document.querySelectorAll('.menu-items .Item');
const sections = document.querySelectorAll('.content-section');

// Función para cambiar a la sección correcta
function changeSection(event) {
    // Primero, ocultamos todas las secciones
    sections.forEach(section => {
        section.classList.remove('active');
        section.classList.add('hidden');
    });

    // Ahora, mostramos la sección correspondiente
    const sectionId = event.target.id.replace('menu-', ''); // Eliminamos el "menu-" del ID
    const activeSection = document.getElementById(sectionId); // Seleccionamos la sección correspondiente

    if (activeSection) {
        activeSection.classList.remove('hidden');
        activeSection.classList.add('active');
    }
}

// Agregamos los event listeners a cada ítem del menú
menuItems.forEach(item => {
    item.addEventListener('click', changeSection);
});
