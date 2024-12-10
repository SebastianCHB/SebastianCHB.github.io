// Selecciona todos los botones de eliminar
document.querySelectorAll(".btnDelete").forEach((btn) => {
    btn.addEventListener("click", () => {
      const id = btn.getAttribute("data-id"); // Obtén el ID desde el botón
      console.log("ID para eliminar:", id);  // Verifica el ID en la consola
      document.getElementById("deleteId").value = id; // Asigna el ID al campo oculto
    });
  });
  