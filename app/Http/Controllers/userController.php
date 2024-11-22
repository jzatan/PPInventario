<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUserrequest;
use App\Http\Requests\updateUserrequest;
use App\Models\area;
use App\Models\User;
use App\Models\usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $areas = area::get();
        $users = User::get();
        // LLamo a los usuarios que esten en  estado 1 = activos
        $usuarios = usuario::where('estado', 1)->get();

        return view('privilegios.users', ['users' => $users], compact('usuarios', 'areas'));
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
    public function store(storeUserRequest $request)
    {
        // Utiliza el método validated() para obtener datos validados
        $validatedData = $request->validated();

        // Encripta la contraseña antes de asignarla al arreglo validado
        $validatedData['password'] = Hash::make($validatedData['password']);

        try {
            DB::beginTransaction();

            // Crea el usuario con los datos validados que incluyen la contraseña encriptada
            $user = User::create($validatedData);

            DB::commit();
            return redirect()->route('users.index')->with('success', 'Usuario registrado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();

            // Considerar mostrar el mensaje de error para entender mejor el problema
            // en el entorno de desarrollo. No hacer esto en producción por razones de seguridad.
            return redirect()->route('users.index')->with('error', 'Error al registrar el usuario: ' . $e->getMessage());
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
    public function update(updateUserrequest $request, user $user)
    {
        //
        try {
            DB::beginTransaction();
            $user->update($request->validated());

            DB::commit();
            return redirect()->route('users.index');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('users.index');
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
            $user = user::findOrFail($id);
            $user->delete();
            return redirect()->route('users.index');
        } catch (Exception $e) {
            return redirect()->route('users.index');
        }
    }
}
