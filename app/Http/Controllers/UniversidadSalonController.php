<?php

namespace App\Http\Controllers;

use App\Models\Universidad;
use Illuminate\Http\Request;
use App\Models\UniversidadSalon;
use App\Models\Salon;
use Illuminate\Support\Facades\DB;

class UniversidadSalonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function crear( $nit)
    {
        
        return view('universidad_salones.create2')->with('nit', $nit);
    }


    public function verificarCapacidad($nit)
{
    // Obtener la capacidad de la universidad
    $universidad = Universidad::where('nit', $nit)->first();
    $capacidadUniversidad = $universidad->capacidad;

    // Contar la cantidad de salones asociados a la universidad
    $cantidadSalones = UniversidadSalon::where('nit', $nit)->count();

    // Calcular la capacidad disponible
    $capacidadDisponible = $capacidadUniversidad - $cantidadSalones;

    return $capacidadDisponible;
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Crear y guardar la universidad
        $universidad = new UniversidadSalon();
        $universidad->id_salon = $request->estilo;
        $universidad->nit = $request->nit;
    
        // Verificar la capacidad de la universidad
        $capacidadDisponible = $this->verificarCapacidad($universidad->nit);
        
        if ($capacidadDisponible > 0) {
            $universidad->save();
            return redirect()->route('universidades_salones.index2', ['nit' => $universidad->nit])->with('success', 'Salon creado exitosamente.');

        } else {
            return redirect()->back()->with('error', 'La universidad no puede contener más salones.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         // Buscar el item por su ID
         $universidadsalon = UniversidadSalon::find($id);
         if ($universidadsalon){
    
           $universidadsalon->delete();
         //  echo "id encontrado";
           return redirect()->back()->with('error',  'SI.');
         }else{
         
          //  echo "id no encontrado";
            return redirect()->back()->with('error',  'No se pudo eliminar .');
         }
    
        // Redirigir a la página index2
       
    }

  public function index2(Request $request)
{
    $nit = $request->input('nit');
    
    // Obtener los registros de universidades_salones para el nit especificado
    $universidadesSalones = UniversidadSalon::where('nit', $nit)->get();
    
    // Array para almacenar los datos de salones
    $salonData = [];

    if (!$universidadesSalones->isEmpty()) {
        foreach ($universidadesSalones as $universidadSalon) {
            $salon = Salon::find($universidadSalon->id_salon);

            if ($salon) {
                $salonData[] = [
                    'id' => $universidadSalon ->id,
                    'nit' => $universidadSalon->nit,
                    'tipo' =>$salon->tipo,
                    'estilo' => $salon->estilo,
                    // Agrega aquí los demás atributos de la tabla salones que necesites
                ];
            }
        }
    }
    
    // Pasar los datos a la vista index2.blade.php
    return view('universidad_salones.index2', compact('salonData'),compact('nit'));
}

    
}
