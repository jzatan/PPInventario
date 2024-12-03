<?php

namespace App\Http\Controllers;

use App\Models\equipo;
use App\Models\mantenimiento;
use App\Models\prestamo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idAreaUsuario = Auth::user()->area_id ?? '';
        $hoy = Carbon::now()->toDateString();

        // Filtrar los equipos por el área del usuario
        //$equipos = equipo::where('area_id', $idAreaUsuario)->get();
        $act_entrada_diario = equipo::where('area_id', $idAreaUsuario)->where('categoria_id', 1)->whereDate('created_at', $hoy)->count();
        $act_entrada = equipo::where('area_id', $idAreaUsuario)->where('categoria_id', 1)->count();

        $act_procesamiento_diario = equipo::where('area_id', $idAreaUsuario)->where('categoria_id', 2)->whereDate('created_at', $hoy)->count();
        $act_procesamiento = equipo::where('area_id', $idAreaUsuario)->where('categoria_id', 2)->count();

        $act_salida_diario = equipo::where('area_id', $idAreaUsuario)->where('categoria_id', 3)->whereDate('created_at', $hoy)->count();
        $act_salida = equipo::where('area_id', $idAreaUsuario)->where('categoria_id', 3)->count();

        // Obtener los últimos 5 registros de la tabla mantenimientos
        //$ultimos_mant = Mantenimiento::latest('created_at')->take(5)->get();
        $ultimos_mant = Mantenimiento::whereHas('equipos', function($query) use ($idAreaUsuario) {
            $query->where('area_id', $idAreaUsuario);
        })
        ->latest('created_at')
        ->take(5)
        ->get();

        //$ultimos_prestamos = prestamo::latest('created_at')->take(5)->get();
        $ultimos_prestamos = Prestamo::whereHas('equipos', function($query) use ($idAreaUsuario) {
            $query->where('area_id', $idAreaUsuario);
        })
        ->latest('created_at')
        ->take(5)
        ->get();


        return view('panel.dashboard-home', compact('act_salida', 'act_entrada', 'act_procesamiento', 'act_entrada_diario', 'act_salida_diario', 'act_procesamiento_diario', 'ultimos_mant','ultimos_prestamos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
