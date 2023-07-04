<!DOCTYPE html>
<html>
<head>
    <title>Universidades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            margin-bottom: 20px;
        }

        .btn-container {
            text-align: right;
            margin-bottom: 10px;
        }

        .btn-container a {
            text-decoration: none;
            color: #fff;
            background-color: #3490dc;
            padding: 10px 15px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn-container a:hover {
            background-color: #2779bd;
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

        .btn-ver {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    
    .btn-eliminar {
        background-color: #E57373;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Universidades</h1>
        <div class="btn-container">
            <a href="{{ route('universidades.create') }}">Crear Universidad</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert error">
            {{ session('error') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>NIT</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Email</th>
                <th>Fecha</th>
                <th>Teléfono</th>
                <th>Capacidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($universidades as $universidad)
            <tr>
                <td>{{ $universidad->nit }}</td>
                <td>{{ $universidad->nombre }}</td>
                <td>{{ $universidad->direccion }}</td>
                <td>{{ $universidad->email }}</td>
                <td>{{ $universidad->fecha }}</td>
                <td>{{ $universidad->telefono }}</td>
                <td>{{ $universidad->capacidad }}</td>
                <td>
                <form method="POST" action="{{ route('universidades.destroy', $universidad->nit) }}" onsubmit="return confirm('¿Estás seguro de eliminar esta universidad?');">
                    @csrf
                 @method('DELETE')
    
            <!-- Botón de eliminación -->
        <button type="submit" class="btn btn-eliminar">Eliminar</button>
    </form>

            <!-- Botón para redireccionar a index2.blade.php -->
            <form action="{{ route('universidades_salones.index2') }}" method="GET">
  
    
    <input type="hidden" name="nit" value="{{ $universidad->nit }}">
    <button type="submit" class="btn btn-ver">Salones</button>
</form>
        </td>
        <td>
 
        </td>
    </tr>
@endforeach
        </tbody>
    </table>


</div>
</body>
</html>
