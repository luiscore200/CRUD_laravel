<!DOCTYPE html>
<html>
<head>
    <title>Salones</title>
    <style>
        /* Estilos CSS */
           .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f5f5f5;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #e9e9e9;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .nn{
            text-align:right;
            padding-bottom: 50px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Salones</h1>
    <div class="nn">
        <a href="{{ route('universidades_salones.crear', ['nit' => $nit]) }}" class="btn btn-success">Crear Salón</a>
        <a href="{{ route('universidades.index') }}" class="btn btn-primary">Regresar</a>
    </div>

    <table>
        <thead>
            <tr>
                <th># actividad</th>
                <th>NIT</th>
                <th>Tipo de Salón</th>
                <th>Estilo de Salón</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salonData as $salon)
            <tr>
                <td>{{ $salon['id'] }}</td>
                <td>{{ $salon['nit'] }}</td>
                <td>{{ $salon['tipo'] }}</td>
                <td>{{ $salon['estilo'] }}</td>
                {{-- Agrega aquí las columnas adicionales que desees mostrar --}}
                <td>
                <form action="{{ route('universidades_salones.destroy', $salon['id']) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta universidad?');">
                        @method('DELETE')
                         @csrf
                         
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</body>
</html>
