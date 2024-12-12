<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{

    public function index()
    {
        //
        if (Auth::check()) {
            return redirect()->route('panel');
        }
        return view('auth.login');
    }

    public function login(loginRequest $request)
    {
        //dd($request);
        if (!Auth::validate($request->only('email', 'password'))) {
            return redirect()->route('login')->withErrors('Credenciales incorrectas');
        }
        $user = Auth::getProvider()->retrieveByCredentials($request->only('email', 'password'));

        // Verifica que el usuario esté activo (estado == 1)
        if ($user->estado !== 1) {
            return redirect()->route('login')->withErrors('El usuario no está activo.');
        }

        Auth::login($user);
        return redirect()->route('panel');
    }
}
