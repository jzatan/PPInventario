<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeEquiposrequest;
use App\Models\componente;
use App\Models\equipo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class componenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //dd($request);

        return view('activos-informaticos.componentes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'componentes.nombre_componente' => 'required|array',
            'componentes.descripcion' => 'nullable|array',

        ]);

        // Recorrer cada componente y guardarlo
        foreach ($request->componentes['nombre_componente'] as $key => $nombre_componente) {
            componente::create([
                'equipo_id' => $validatedData['equipo_id'],
                'nombre_componente' => $nombre_componente,
                'descripcion' => $request->componentes['descripcion'][$key] ?? null,

            ]);
        }

        return redirect()->route('equipos.index')->with('success', 'Componentes guardados correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
