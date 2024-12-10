document.querySelectorAll(".btnEdit").forEach((btn) => {
  btn.addEventListener("click", () => {
    // Obtén los datos del botón
    const id = btn.getAttribute("data-id");
    const name = btn.getAttribute("data-name");
    const email = btn.getAttribute("data-email");

    // Asigna los datos a los campos del modal
    document.getElementById("txtIdEdit").value = id;
    document.getElementById("txtNamee").value = name;
    document.getElementById("txtEmaill").value = email;

    // Debugging: Verifica en la consola
    console.log("Datos enviados al modal:", { id, name, email });
  });
});
