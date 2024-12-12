<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análisis de Carencia Médica</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- CSS -->
 
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            text-align: center;
        }

        /* Contenedor principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Gráfico */
        #carenciaChart {
            display: block;
            margin: 0 auto 40px auto;
        }

        /* Información del departamento */
        #departamentoInfo {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        #departamentoInfo h3 {
            margin-top: 0;
        }

        #departamentoInfo p {
            font-size: 1.2em;
        }

        /* Barra lateral de estadísticas adicionales */
        .sidebar {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }


        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            font-size: 1em;
            margin-bottom: 10px;
        }

        .sidebar ul li span {
            font-weight: bold;
        }

        /* Estilo para el pie de página */
        footer {
            text-align: center;
            color: white;
            padding: 10px;
            margin-top: 50px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Análisis de Carencia Atencion Médica</h1>
        <h2>Comparativa de Carencia Médica por Departamento</h2>

        <canvas id="carenciaChart" width="400" height="200"></canvas>
        
        <!-- Información del departamento y la carencia -->
        <div id="departamentoInfo">
            <h3>Departamento: <span id="departamentoNombre"></span></h3>
            <p id="carenciaInfo"></p>
        </div>


    </div>

    <footer>
        <p>&copy; 2024 Análisis de Carencia Médica. Todos los derechos reservados.</p>
    </footer>

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

        // Mostrar la información del departamento debajo del gráfico
        document.getElementById('departamentoNombre').textContent = departamentoSeleccionado;
        document.getElementById('carenciaInfo').textContent = `El departamento de ${departamentoSeleccionado} tiene un porcentaje de carencia médica de ${carenciaSeleccionada}%`;

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
