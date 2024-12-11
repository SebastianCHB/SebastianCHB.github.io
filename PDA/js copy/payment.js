var botonesEditar = document.getElementsByClassName("btnEdit");

for (var i = 0; i < botonesEditar.length; i++) {
  botonesEditar[i].onclick = function(evt) {
    var btn = evt.target;

    if (btn.tagName !== "BUTTON") btn = btn.closest("button");

    var idPaquete = btn.getAttribute("data-id");
    var nombre = btn.getAttribute("data-name");
    var descripcion = btn.getAttribute("data-desc");
    var precio = btn.getAttribute("data-price");
    var duracion = btn.getAttribute("data-durac");
    var imagen = btn.getAttribute("data-img");

   
    document.getElementById("pname").value = nombre;
    document.getElementById("pdesc").value = descripcion;
    document.getElementById("pprecio").value = precio;
    document.getElementById("pduracion").value = duracion;
    document.getElementById("img-name").innerText = imagen;
    document.getElementById("txtId").value = idPaquete;  
  };
}
