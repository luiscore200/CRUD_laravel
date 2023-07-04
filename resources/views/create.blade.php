<!DOCTYPE html>
<html>
<head>
    <title>Crear Universidad</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        
        .container {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-wrapper {
            background-color: #f5f5f5;
            border-radius: 8px;
            padding: 20px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        .form-input[readonly] {
            background-color: #f5f5f5;
        }

        .form-actions {
            text-align: center;
        }

        .form-actions .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-actions .btn-cancel {
            background-color: #dc3545;
            margin-right: 10px;
        }

        .form-actions .btn-cancel:hover {
            background-color: #c82333;
        }

        .form-actions .btn-create {
            background-color: #28a745;
           
        }

        .form-actions .btn-create:hover {
            background-color: #218838;
        }

        .form-input.valid {
            border-color: green;
        }

        .form-input.invalid {
            border-color: red;
        }

        .mensaje {
            padding: 10px;
            font-weight: bold;
        }

        .mensaje.verde {
            color: green;
        }

        .mensaje.rojo {
            color: red;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <h2 class="form-title">Crear Universidad</h2>
            <form action="{{ route('universidades.store') }}" method="POST">
                @csrf
                <label class="form-label">NIT</label>
                <input type="text" name="nit" value="" readonly class="form-input">

                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" required class="form-input">

                <p id="mensaje-nombre" class="mensaje"></p>
                
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" placeholder="Dirección" required class="form-input" pattern="[A-Za-z0-9\s]+">

                <label class="form-label">Email</label>
                <input type="email" name="email" placeholder="Email" required class="form-input" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">

                <label class="form-label">Fecha</label>
                <input type="date" name="fecha" placeholder="Fecha" required class="form-input">

                <label class="form-label">Teléfono</label>
                <input type="tel" name="telefono" placeholder="Teléfono" required pattern="[0-9]{10}" maxlength="10" class="form-input" title="Ingrese un número de teléfono válido de 10 dígitos">

                <label class="form-label">Capacidad</label>
                <input type="number" name="capacidad" placeholder="Capacidad" required min="1" class="form-input">

                @if(session('error'))
                    <div class="alert alert-danger">
                        <br>
                        {{ session('error') }}
                    </div>
                @endif
                <br>
                <div class="form-actions">
                    <a href="{{ route('universidades.index') }}" class="btn btn-cancel">Cancelar</a>
                    <button type="submit" class="btn btn-create">Crear</button>
                </div>
            </form>

            <script>
                $(document).ready(function() {
                    $('#nombre').on('input', function() {
                        var nombre = $(this).val();

                        // Realizar la llamada AJAX para verificar el nombre
                        $.ajax({
                            url: '/universidades/verificarNombre/' + nombre,
                            type: 'GET',
                            success: function(response) {
                                if (response.existe) {
                                    $('#nombre').removeClass('valid').addClass('invalid');
                                    $('#mensaje-nombre').removeClass('verde').addClass('rojo').text('El nombre ya está en uso.');
                                } else {
                                    $('#nombre').removeClass('invalid').addClass('valid');
                                    $('#mensaje-nombre').removeClass('rojo').addClass('verde').text('El nombre está disponible.');
                                }
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>
</body>
</html>
