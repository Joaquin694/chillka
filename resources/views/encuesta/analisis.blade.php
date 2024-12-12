<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análisis de Carencia Médica</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Análisis de Carencia Médica</h1>
    
    <h2>Comparativa de Carencia Médica</h2>
    
    <canvas id="carenciaChart" width="400" height="200"></canvas>

    <script>
        const ctx = document.getElementById('carenciaChart').getContext('2d');
        
        // Etiquetas: los nombres de los departamentos
        const departamentos = @json($departamentos).map(departamento => departamento.nombre_departamento);
        
        // Datos de carencia para cada departamento
        const carencias = @json($carencias);
        
        // Obtener los porcentajes de carencia de cada departamento
        const carenciaData = departamentos.map(departamento => carencias[departamento] || 0);
        
        // Resaltar el departamento seleccionado
        const departamentoSeleccionado = @json($departamentoSeleccionado);
        const carenciaSeleccionada = carencias[departamentoSeleccionado] || 0;

        const data = {
            labels: departamentos,
            datasets: [{
                label: 'Porcentaje de Carencia Médica',
                data: carenciaData,
                backgroundColor: departamentos.map(departamento => departamento === departamentoSeleccionado ? 'rgba(255, 99, 132, 0.2)' : 'rgba(54, 162, 235, 0.2)'),
                borderColor: departamentos.map(departamento => departamento === departamentoSeleccionado ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'),
                borderWidth: 1
            }]
        };

        const carenciaChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>