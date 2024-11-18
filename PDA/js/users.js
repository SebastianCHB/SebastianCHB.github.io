document.getElementById("btnSave").onclick =(evt)=>{
    evt.preventDefault()//evita recargar el form
    document.getElementById("form").classList.add('was-validated')

    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: "success",
        title: "Datos guardados"
      });

}