const ctx = document.getElementById('chartIngresos');

new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
    datasets: [{
      label: 'Ingresos por mes',
      data: [0,1000,500,200,200,100,0,0,0,0,0,0],
      borderWidth: 2
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});


const ctx1 = document.getElementById('chartCategorias');

  new Chart(ctx1, {
    type: 'bar',
    data: {
      labels: ['Beach', 'Hotels', 'Museum', 'Others'],
      datasets: [{
        label: 'Top Reservations',
        data: [1, 1, 0, 0],
        borderWidth: 2
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });