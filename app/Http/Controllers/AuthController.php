<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MOSTRAR VISTA REGISTRO
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('auth.register');
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTRAR USUARIO
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        $request->validate(

            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'role' => 'required'
            ],

            [
                'name.required' => 'El nombre es obligatorio',

                'email.required' => 'El correo es obligatorio',

                'email.email' => 'Debes escribir un correo válido',

                'email.unique' => 'Este correo ya está registrado',

                'password.required' => 'La contraseña es obligatoria',

                'password.min' => 'La contraseña debe tener mínimo 6 caracteres',

                'role.required' => 'Debes seleccionar un rol'
            ]

        );

        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => $request->password,

            'role' => $request->role

        ]);

        Auth::login($user);

        if ($user->role == 'productor') {
            return redirect('/productor/dashboard');
        }

        return redirect('/cliente/dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | MOSTRAR LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $credentials = $request->validate(

            [
                'email' => 'required|email',
                'password' => 'required'
            ],

            [
                'email.required' => 'El correo es obligatorio',

                'email.email' => 'Debes escribir un correo válido',

                'password.required' => 'La contraseña es obligatoria'
            ]

        );

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if (Auth::user()->role == 'productor') {
                return redirect('/productor/dashboard');
            }

            return redirect('/cliente/dashboard');
        }

        return back()->withErrors([

            'email' => 'Correo o contraseña incorrectos'

        ])->onlyInput('email');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}