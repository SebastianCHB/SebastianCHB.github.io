const ctx = document.getElementById('chartIngresos');

new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
    datasets: [{
      label: 'ingresos por mes',
      data: [200000, 300000, 250000, 500000, 600000, 320000,104443,20000,15000,212333,550000,100000],
      borderWidth: 1
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
    type: 'pie',
    data: {
      labels: ['Desayuños', 'Comida', 'Cenas', 'Snacks'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 2],
        borderWidth: 1
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