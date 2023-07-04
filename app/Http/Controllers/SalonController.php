<?php

namespace App\Http\Controllers;
use App\Models\Salon;
use Illuminate\Http\Request;

class SalonController extends Controller
{
    public function obtenerTipos()
    {
        $tipos = Salon::distinct()->pluck('tipo'); // Obtener los nombres de tipo únicos
        
        return response()->json($tipos);
    }

  public function obtenerEstilos($tipo)
{
    $estilos = Salon::where('tipo', $tipo)->pluck('estilo', 'id');
    
    return response()->json($estilos);
}
}
