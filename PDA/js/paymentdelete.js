// Captura todos los botones de eliminación
var botonesEliminar = document.getElementsByClassName("btnDelete");

for (var i = 0; i < botonesEliminar.length; i++) {
  botonesEliminar[i].onclick = function(evt) {
    var btn = evt.target;
    // Verifica si se ha hecho clic en el icono del botón
    if (btn.tagName !== "BUTTON") btn = btn.closest("button");
    
    // Obtiene el id_paquete desde el atributo data-id
    var idPaquete = btn.getAttribute("data-id");

    // Asigna el id_paquete al campo oculto en el modal
    document.getElementById("deleteIdPaquete").value = idPaquete;
  };
}
