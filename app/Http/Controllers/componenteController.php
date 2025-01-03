<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeEquiposrequest;
use App\Http\Requests\updateComponentesrequest;
use App\Models\componente;
use App\Models\equipo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class componenteController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:create-componentes', ['only' => ['create']]);
        $this->middleware('permission:store-componentes', ['only' => ['store']]);
        $this->middleware('permission:update-componentes', ['only' => ['update']]);
        $this->middleware('permission:delete-componentes', ['only' => ['destroy']]);
    }

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

        return redirect()->route('activosregistrados')->with('success', 'Componentes guardados correctamente.');
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
    public function update(updateComponentesrequest $request, componente $componente)
    {
        //dd($request);
        try {
            DB::beginTransaction();
            $componente->update($request->validated());
            DB::commit();
            return redirect()->route('activosregistrados');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('activosregistrados');
        }
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
        try {
            $componente = componente::findOrFail($id);
            $componente->delete();
            return redirect()->route('activosregistrados');
        } catch (Exception $e) {
            return redirect()->route('activosregistrados');
        }
    }
}
