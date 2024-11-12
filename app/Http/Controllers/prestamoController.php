<?php

namespace App\Http\Controllers;

use App\Http\Requests\storePrestamosrequest;
use App\Models\area;
use App\Models\componente;
use App\Models\equipo;
use App\Models\prestamo;
use App\Models\usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class prestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $prestamos = prestamo::where('estado',0)->get();
        //$prestamos = prestamo::get();
        $equipos = equipo::whereIn('estado', [3])->get(); //??
        $componentes = componente::with('equipos')->get();
        return view('prestamos.control-prestamos', compact('componentes', 'equipos', 'prestamos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(equipo $equipo)
    {


        // LLamo a los usuarios que esten en  estado 1 = activos
        $usuarios = usuario::where('estado', 1)->get();

        // LLamo a las areas que estan en estado 1 = activos
        $areas = area::where('estado', 1)->get();

        // Llamo a los esquipos que estan en estado 0, 1 , 4 = operativos y regulares
        $equipos = equipo::whereIn('estado', [0, 1, 4])->get();

        return view('prestamos.store-prestamo', compact('usuarios', 'equipos', 'equipo', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePrestamosrequest $request)
    {
        //
        //dd($request);
        try {
            DB::beginTransaction();

            // Registrar el préstamo
            $prestamo = Prestamo::create($request->validated());

            // Actualizar el estado del equipo a "NO DISPONIBLE"
            $equipo = Equipo::find($request->equipo_id);
            if ($equipo) {
                $equipo->estado_prestamo = '0';
                $equipo->save();
            }

            DB::commit();

            return redirect()->route('prestamos.index')->with('success', 'Préstamo registrado exitosamente y equipo actualizado');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('prestamos.index')->with('error', 'Error al registrar el préstamo');
        }
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

    public function devolucion(Request $request)
    {
        try {
            // Actualizar el estado del préstamo
            $prestamo = Prestamo::find($request->prestamo_id);
            if ($prestamo) {
                $prestamo->estado = 1; // Por ejemplo, "MALA"
                $prestamo->save();
            }

            // Actualizar el estado del equipo a "DISPONIBLE"
            $equipo = Equipo::find($request->equipo_id);
            if ($equipo) {
                $equipo->estado_prestamo = 1; // Asumimos que 1 es "DISPONIBLE"
                $equipo->save();
            }

            return response()->json(['success' => true, 'message' => 'Devolución exitosa']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error en la devolución']);
        }
    }
}
