<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Salones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #f5f5f5;
            border-radius: 8px;
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        select,
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        .form-actions {
            display: flex;
            justify-content: center; 
        }

        .btn-cancel,
        .btn-create {
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-cancel {
            background-color: #dc3545;
            margin-right: 10px;
            color: #fff;
            border: none;
        }

        .btn-create {
            background-color: #28a745;
            color: #fff;
            border: none;
        }

        .btn-cancel:hover {
            background-color: #c82333;
        }

        .btn-create:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Formulario de Salones</h1>

    <form action="{{ route('universidades_salones.store') }}" method="POST">
    @csrf
        <label for="nit">NIT:</label>
        <input type="text" name="nit" value="{{ $nit }}" readonly>

        <label for="selectTipo">Tipo:</label>
        <select id="selectTipo" name="tipo" required>
            <option value="">--- Seleccione tipo ---</option>
        </select>

        <label for="selectEstilo">Estilo:</label>
        <select id="selectEstilo" name="estilo" required>
            <option value="">--- Seleccione estilo ---</option>
        </select>
        
        @if(session('error'))
                <div class="alert alert-danger"><br>
                    {{ session('error') }}
                </div>
            @endif
                    <br>

        <div class="form-actions">
            <a href="{{ route('universidades_salones.index2', ['nit' => $nit]) }}" class="btn btn-cancel">Cancelar</a>
            <button type="submit" class="btn btn-create">Crear</button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Realizar solicitud AJAX al cargar la página
        $(document).ready(function () {
            $.ajax({
                url: '{{ route("salones.obtenerTipos") }}',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    var selectTipo = $('#selectTipo');

                    // Limpiar opciones existentes en el select "tipo"
                    selectTipo.empty();

                    // Agregar las nuevas opciones desde los datos obtenidos al select "tipo"
                    selectTipo.append($('<option></option>').val('').text('--- Seleccione tipo ---'));
                    $.each(data, function (index, tipo) {
                        selectTipo.append($('<option></option>').val(tipo).text(tipo));
                    });

                    // Disparar el evento "change" para actualizar los estilos según el tipo inicialmente seleccionado
                    selectTipo.trigger('change');
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });

        // Manejar cambio de opción en el select "tipo"
        $('#selectTipo').on('change', function () {
            var tipoSeleccionado = $(this).val();
            var selectEstilo = $('#selectEstilo');

            // Limpiar opciones existentes en el select "estilo"
            selectEstilo.empty();

            // Realizar solicitud AJAX para obtener los estilos según el tipo seleccionado
            $.ajax({
                url: '/salones/obtener-estilos/' + tipoSeleccionado,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Agregar las nuevas opciones desde los datos obtenidos al select "estilo"
                    $.each(data, function (id, estilo) {
                        selectEstilo.append($('<option></option>').val(id).text(estilo));
                    });
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });
    </script>
</body>
</html>
