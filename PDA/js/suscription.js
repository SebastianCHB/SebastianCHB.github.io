document.querySelectorAll('.btndeletesus').forEach(button => {
    button.onclick = (evt) => {
      Swal.fire({
        title: "Do you want to delete this suscription?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Deleted!",
            text: "The suscription has been deleted.",
            icon: "success"
          });
        }
      });
    };
  });
  