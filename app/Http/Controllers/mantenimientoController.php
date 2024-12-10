<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeMantenimientorequest;
use App\Http\Requests\updateMantenimientorequest;
use App\Models\area;
use App\Models\equipo;
use App\Models\mantenimiento;
use App\Models\mantenimiento_detalle;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; //OJO 
use Exception;
use Illuminate\Support\Facades\Auth;

class mantenimientoController extends Controller
{
   
    function __construct() {

        $this->middleware('permission:ver-mantenimientos',['only'=>['index']]);
        $this->middleware('permission:ver-mantenimientos-generales',['only'=>['mantenimientosgenerales']]);
        $this->middleware('permission:create-mantenimientos',['only'=>['create']]);
        $this->middleware('permission:store-mantenimientos',['only'=>['store']]);
        $this->middleware('permission:edit-mantenimeintos',['only'=>['edit']]);
        $this->middleware('permission:update-mantenimientos',['only'=>['update']]);
        

    }

    public function mantenimientosgenerales(){
         // Filtrar los equipos por el área del usuario
         $equipos = Equipo::where('estado_prestamo',1)->get();
         $mantenimientos = mantenimiento::all();
         return view('mantenimientos.control-mantenimientos-generales', compact('equipos', 'mantenimientos'));

    }


    public function index()
    {
        //

        $idAreaUsuario = Auth::user()->area_id ?? '';

        // Filtrar los equipos por el área del usuario
        $equipos = Equipo::where('area_id', $idAreaUsuario)->get();

        $mantenimientos = mantenimiento::all();
        //$equipos = equipo::get(); //


        return view('mantenimientos.control-mantenimientos', compact('equipos', 'mantenimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(equipo $equipo)
    {

        // LLamo a los usuarios que esten en  estado 1 = activos
        $usuarios = usuario::where('id', '!=', 1)->where('estado', 1)->get();
      


        // LLamo a las areas que estan en estado 1 = activos
        $areas = area::where('estado', 1)->get();

        return view('mantenimientos.store-mantenimiento', compact('usuarios', 'equipo', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeMantenimientorequest $request)
    {
        //
        try {
            DB::beginTransaction();

            // Insertar en detalles_mantenimiento
            $detalleId = DB::table('mantenimiento_detalles')->insertGetId([
                'fecha_envio' => $request->fecha_envio,
                'fecha_retorno' => $request->fecha_retorno,
                'problema' => $request->problema,
                'diagnostico' => $request->diagnostico,
                'estado_mantenimiento' => $request->estado_mantenimiento,
                'observaciones' => $request->observaciones,
            ]);

            // Insertar en mantenimientos
            DB::table('mantenimientos')->insert([
                'equipo_id' => $request->equipo_id,
                'mantenimiento_detalle_id' => $detalleId,
                'id_usuario_mantenimiento' => $request->id_usuario_mantenimiento,
                'estado' => $request->estado
            ]);

            // Verificar si el estado del mantenimiento es igual a 1
            $equipo = equipo::find($request->equipo_id);
            if ($equipo) {
                if ($request->estado_mantenimiento == '1' && $request->estado == '1') {
                    $equipo->estado = '4'; // EN MANTENIMIENTO
                } elseif ($request->estado_mantenimiento == '2' && $request->estado == '1') {
                    $equipo->estado = '4'; // EN MANTENIMIENTO
                } elseif ($request->estado_mantenimiento == '2' && $request->estado == '2') {
                    $equipo->estado = '4'; // EN MANTENIMIENTO
                } elseif ($request->estado_mantenimiento == '1' && $request->estado == '2') {
                    $equipo->estado = '4'; // EN MANTENIMIENTO
                } elseif ($request->estado_mantenimiento == '3' && $request->estado == '1') {
                    $equipo->estado = '1'; // DISPONIBLE
                } elseif ($request->estado_mantenimiento == '3' && $request->estado == '2') {
                    $equipo->estado = '3'; // NO DISPONIBLE
                }
                $equipo->save();
            }


            DB::commit();
            return redirect()->route('mantenimientosgenerales')->with('success', 'Mantenimiento registrado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Error al registrar el mantenimiento: ' . $e->getMessage());
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
    public function edit(mantenimiento $mantenimiento)
    {
        //
        // LLamo a los usuarios que esten en  estado 1 = activos
        $usuarios = usuario::where('id', '!=', 1)->where('estado', 1)->get();

        // LLamo a las areas que estan en estado 1 = activos
        $areas = area::where('estado', 1)->get();

        return view('mantenimientos.update-mantenimiento', ['mantenimiento' => $mantenimiento], compact('areas', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateMantenimientorequest $request, $id)
    {
        //
        //dd($request);
        try {
            // Buscar el mantenimiento por ID
            $mantenimiento = Mantenimiento::findOrFail($id);
    
            // Iniciar una transacción para actualizar ambas tablas
            DB::transaction(function () use ($request, $mantenimiento) {
                // Actualizar el modelo Mantenimiento
                $mantenimiento->update([
                    'id_usuario_mantenimiento' => $request->input('id_usuario_mantenimiento'),
                    'estado' => $request->input('estado'),
                ]);
    
                // Actualizar el modelo DetallesMantenimiento relacionado
                $detalle = $mantenimiento->mantenimiento_detalle;
                if ($detalle) {
                    $detalle->update([
                        'fecha_retorno' => $request->input('fecha_retorno'),
                        'problema' => $request->input('problema'),
                        'diagnostico' => $request->input('diagnostico'),
                        'observaciones' => $request->input('observaciones'),
                        'estado_mantenimiento' => $request->input('estado_mantenimiento'),
                    ]);
                }
            });
    
            // Redirigir con éxito
            return redirect()->route('mantenimientosgenerales')->with('success', 'Mantenimiento y detalles actualizados correctamente.');
        } catch (\Exception $e) {
            // Capturar cualquier error y redirigir con mensaje de error
            return redirect()->route('mantenimientosgenerales')->with('error', 'Ocurrió un error al actualizar: ' . $e->getMessage());
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
    }
}
