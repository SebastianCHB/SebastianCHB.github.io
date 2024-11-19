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

document.querySelectorAll('.btndelete').forEach(button => {
  button.onclick = (evt) => {
    Swal.fire({
      title: "Do you want to delete this user?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Deleted!",
          text: "The user has been deleted.",
          icon: "success"
        });
      }
    });
  };
});
