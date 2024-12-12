<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta Completa</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            max-width: 600px;
            margin: auto;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        select,
        input,
        button {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007BFF;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        #hogar-section {
            display: none;
            /* Oculto por defecto */
        }
    </style>
</head>

<body>
    <h1>Encuesta Completa</h1>
    <form action="{{ route('encuesta.mostrar') }}" method="POST">
        @csrf

        <!-- Selección de Departamento -->
        <label for="departamento">Selecciona tu departamento:</label>
        <select id="departamento" name="departamento_id" required>
            <option value="">Seleccione un departamento</option>
            @foreach ($departamentos as $departamento)
                <option value="{{ $departamento->id_departamento }}" @if (isset($departamentoSeleccionado) && $departamentoSeleccionado == $departamento->id_departamento) selected @endif>
                    {{ $departamento->nombre_departamento }}
                </option>
            @endforeach
        </select>


        <!-- Selección de Ciudad -->
        @if (isset($ciudades))
            <label for="ciudad">Selecciona tu ciudad:</label>
            <select id="ciudad" name="ciudad_id" onchange="mostrarHogarSection()" required>
                <option value="">Seleccione una ciudad</option>
                @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad->id_ciudad }}">{{ $ciudad->nombre_ciudad }}</option>
                @endforeach
            </select>
        @endif

        <!-- Sección de Datos del Hogar (Oculta por defecto) -->
        <div id="hogar-section">
            <label for="direccion">Dirección del hogar:</label>
            <input type="text" id="direccion" name="direccion" placeholder="Ingrese su dirección exacta" required>

            <!-- Servicios Básicos -->
            <label>Servicios básicos disponibles:</label>
            <div>
                <label><input type="checkbox" name="servicios[]" value="agua"> Agua</label>
                <label><input type="checkbox" name="servicios[]" value="luz"> Luz</label>
                <label><input type="checkbox" name="servicios[]" value="saneamiento"> Saneamiento</label>
                <label><input type="checkbox" name="servicios[]" value="internet"> Internet</label>
            </div>
        </div>

        <!-- Datos del Usuario -->
        <h2>Información del Usuario</h2>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" placeholder="Ingrese su apellido" required>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" placeholder="Ingrese su edad" required>

        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>

        <label for="estado_civil">Estado civil:</label>
        <select id="estado_civil" name="estado_civil" required>
            <option value="soltero">Soltero/a</option>
            <option value="casado">Casado/a</option>
            <option value="otro">Otro</option>
        </select>

        <!-- Datos de la Familia -->
        <h2>Información de Familiares</h2>
        <label for="vive_con_familia">¿Vives con tu familia?</label>
        <select id="vive_con_familia" name="vive_con_familia" required>
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>

        <div id="familia-section" style="display: none;">
            <label for="tipo_familiar">Tipo de familiar:</label>
            <select id="tipo_familiar" name="tipo_familiar">
                <option value="padre">Padre</option>
                <option value="madre">Madre</option>
                <option value="hijo">Hijo/a</option>
                <option value="hermano">Hermano/a</option>
            </select>

            <label for="ciudad_familiar">Ciudad donde vive tu familiar:</label>
            <select id="ciudad_familiar" name="ciudad_familiar">
                @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad->id_ciudad }}">{{ $ciudad->nombre_ciudad }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Enviar Encuesta</button>
    </form>

    <script>
        document.getElementById('departamento').addEventListener('change', function () {
            const departamento_id = this.value;
            if (departamento_id) {
                fetch(`/ciudades/${departamento_id}`)
                    .then(response => response.json())
                    .then(data => {
                        const ciudadSelect = document.getElementById('ciudad');
                        ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>'; // Limpiar opciones previas
                        data.forEach(ciudad => {
                            const option = document.createElement('option');
                            option.value = ciudad.id_ciudad;
                            option.textContent = ciudad.nombre_ciudad;
                            ciudadSelect.appendChild(option);
                        });
                        document.getElementById('ciudad').style.display = 'block'; // Asegura que el campo de ciudad se vea
                    });
            } else {
                document.getElementById('ciudad').style.display = 'none'; // Ocultar el campo de ciudad si no se selecciona departamento
            }
        });
    </script>


    <script>
        function mostrarHogarSection() {
            const ciudad = document.getElementById('ciudad').value;
            const hogarSection = document.getElementById('hogar-section');
            if (ciudad) {
                hogarSection.style.display = 'block';
            } else {
                hogarSection.style.display = 'none';
            }
        }

        document.getElementById('vive_con_familia').addEventListener('change', function () {
            const familiaSection = document.getElementById('familia-section');
            familiaSection.style.display = this.value == '0' ? 'block' : 'none';
        });
    </script>

</body>

</html>