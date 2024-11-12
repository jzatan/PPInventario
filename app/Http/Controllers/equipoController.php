<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeEquiposrequest;
use App\Http\Requests\updateEquiposrequest;
use App\Models\categoria;
use App\Models\componente;
use App\Models\equipo;
use App\Models\usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class equipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$componentes = componente::get();
        $equipos = equipo::get();
        $componentes = Componente::with('equipos')->get(); // Asegúrate de que el modelo Componente tenga la relación definida
        return view('activos-informaticos.activos-informaticos', compact('componentes', 'equipos'));
    }


    // ruta que me permite visualizar los activos informaticos disponibles

    public function activosdisponibles()
    {
        $equipos = equipo::whereIn('estado', [1,2])->get();
        $componentes = componente::with('equipos')->get();
        return view('prestamos.prestamo-activos', compact('componentes', 'equipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $usuarios = usuario::where('estado', 1)->get();
        $categorias = categoria::get();
        return view('activos-informaticos.registro-equipos', compact('usuarios', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeEquiposrequest $request)
    {
        try {
            DB::beginTransaction();

            // Crear el nuevo equipo
            $equipos = equipo::create($request->validated());
            // Almacenar el equipo creado en una sesión
            session(['equipo' => $equipos]);
            DB::commit();

            // Verificar qué botón fue presionado
            if ($request->input('action') === 'register_and_redirect') {
                return redirect()->route('componentes.create')->with('success', 'Equipo registrado exitosamente.');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Error al registrar el equipo.')->withInput();
        }
        // Redirigir a la vista de creación de equipos por defecto
        return redirect()->route('equipos.index')->with('success', 'Equipo registrado exitosamente.');
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
    public function edit(equipo $equipo)
    {
        $usuarios = usuario::where('estado', 1)->get();
        $categorias = categoria::get();
        return view('activos-informaticos.update-activos-informaticos', ['equipo' => $equipo], compact('usuarios', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateEquiposrequest $request, equipo $equipo)
    {
        //
        //dd($request);
        try {
            DB::beginTransaction();
            $equipo->update($request->validated());
            DB::commit();
            return redirect()->route('equipos.index');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('equipos.index');
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
        //
        try {
            $equipo = equipo::findOrFail($id);
            $equipo->delete();
            return redirect()->route('equipos.index');
        } catch (Exception $e) {
            return redirect()->route('equipos.index');
        }
    }


    // Funcion que me permitira validar en tiempo real si el cod_registro existe

    public function verificarcodregistro(Request $request)
    {
        $codregistro = $request->query('cod_registro');
        $exists = equipo::where('cod_registro', $codregistro)->exists();
        return response()->json(['exists' => $exists]);
    }
}
