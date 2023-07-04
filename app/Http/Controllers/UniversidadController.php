<?php

namespace App\Http\Controllers;

use App\Models\Universidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UniversidadController extends Controller
{
    public function index()
    {
        $universidades = Universidad::all();
        return view('index', compact('universidades'));
    }

    public function create()
    {
        $universidades = Universidad::all(); // Obtén los registros de la tabla universidades
    
        return view('create')->with('universidades', $universidades);
    }
    public function verificarNombre($nombre)
    {
        $existe = Universidad::where('nombre', $nombre)->exists();
    
        return response()->json(['existe' => $existe]);
    }


    public function store(Request $request)
    {
        $nombre = $request->nombre;
    
        // Verificar si el nombre ya está en uso
        $existingUniversidad = Universidad::where('nombre', $nombre)->first();
        if ($existingUniversidad) {
            return redirect()->back()->with('error', 'El nombre de universidad ya está en uso.');
        }
    
        // Crear y guardar la universidad
        $universidad = new Universidad();
        $universidad->nombre = $nombre;
        $universidad->direccion = $request->direccion;
        $universidad->email = $request->email;
        $universidad->fecha = $request->fecha;
        $universidad->telefono = $request->telefono;
        $universidad->capacidad = $request->capacidad;
        // Agrega aquí el código para las demás columnas
    
        $universidad->save();
    
        return redirect()->route('universidades.index')->with('success', 'Universidad creada exitosamente.');
    }
    

    public function edit(Universidad $universidad)
    {
        return view('universidades.edit', compact('universidad'));
    }

    public function update(Request $request, Universidad $universidad)
    {
        $universidad->nombre = $request->nombre;
        $universidad->direccion = $request->direccion;
        $universidad->email = $request->email;
        $universidad->fecha = $request->fecha;
        $universidad->telefono = $request->telefono;
        $universidad->capacidad = $request->capacidad;
        // Agrega aquí el código para las demás columnas
        
        $universidad->save();

        return redirect()->route('universidades.index')->with('success', 'Universidad actualizada exitosamente.');
    }

   

    public function destroy(Universidad $universidad)
    {
        // Verificar si la universidad está registrada en la tabla "universidades_salones"
        $existeRelacion = DB::table('universidades_salones')
            ->where('nit', $universidad->nit)
            ->exists();
        
        if ($existeRelacion) {
            return redirect()->back()->with('error',  'No se puede eliminar la universidad porque está asociada a uno o más salones.');
            
        }
        
        // Si no hay relación, se puede proceder a eliminar la universidad
        $universidad->delete();
    
        return redirect()->route('universidades.index')->with('success', 'Universidad eliminada correctamente.');
    }
}
