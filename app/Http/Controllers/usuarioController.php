<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUsuariosrequest;
use App\Http\Requests\updateUsuariosrequest;
use App\Models\area;
use App\Models\usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class usuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Llama a todos los usuarios creados
        $usuarios = usuario::get();

        // LLama a todas las areas creadas en estado 1 = activas
        $areas = area::where('estado',1)->get();

        // Devuelve los datos enviados en las vista auth.registro-usuarios
        return view('auth.registro-usuarios',['usuarios'=>$usuarios], compact('areas'));
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
    public function store(storeUsuariosrequest $request)
    {
        //
        //dd($request);
        try{
            DB::beginTransaction();
            $usuarios = usuario::create($request->validated());
            DB::commit();

        }catch(Exception $e){
            DB::rollBack();

        }
        return redirect()->route('usuarios.index')->with('success','usuario registrado exitosamente');
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
    public function edit(usuario $usuario)
    {
        $areas = area::where('estado',1)->get();
        // abrira la vista update-usuarios, enviando los datos con el id
        return view('auth.update-usuarios',['usuario' => $usuario], compact('areas'));

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateUsuariosrequest $request, usuario $usuario)
    {
        //dd($request);
        try{
            DB::beginTransaction();
            $usuario -> update($request -> validated());
            DB::commit();
            return redirect()->route('usuarios.index');
        } catch (Exception $e){
            DB::rollBack();
            return redirect()->route('usuarios.index');
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
        try{
            $usuario = usuario::findOrFail($id);
            $usuario -> delete();
            return redirect()->route('usuarios.index');

        }catch(Exception $e){
            return redirect()->route('usuarios.index');

        }
    }

    // Funcion que me permitira validar en tiempo real si el nombre de usuario existe

    public function verificarusuario(Request $request){
        $usuario = $request -> query('usuario');
        $exists = usuario::where('usuario', $usuario) -> exists();
        return response() -> json(['exists' => $exists]);

    }
}
