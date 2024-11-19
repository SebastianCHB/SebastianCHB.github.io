document.querySelectorAll('.btndeletepay').forEach(button => {
    button.onclick = (evt) => {
      Swal.fire({
        title: "Do you want to delete this payment method",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Deleted!",
            text: "The payment method has been deleted.",
            icon: "success"
          });
        }
      });
    };
  });
  