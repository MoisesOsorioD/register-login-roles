<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Enums\RoleEnum;

//  INICIO
Route::get('/', function () {

    return view('welcome');

});


// DASHBOARD AUTOMÁTICO
Route::get('/dashboard', function () {

    if (Auth::user()->role == RoleEnum::PRODUCTOR->value) {

        return redirect('/productor/dashboard');

    }

    return redirect('/cliente/dashboard');

})->middleware('auth.custom');


// RUTAS GUEST
// Solo usuarios NO autenticados 
Route::middleware('guest.custom')->group(function () {

    //  REGISTRO
    Route::get('/register', [AuthController::class, 'showRegister']);

    Route::post('/register', [AuthController::class, 'register']);


    // LOGIN
    Route::get('/login', [AuthController::class, 'showLogin']);

    Route::post('/login', [AuthController::class, 'login']);


    // RECUPERAR CONTRASEÑA
    // FORMULARIO OLVIDÉ MI CONTRASEÑA
    Route::get('/forgot-password', function () {

        return view('auth.forgot-password');

    })->name('password.request');


    // ENVIAR CORREO
    Route::post('/forgot-password', function (Request $request) {

        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT

            ? back()->with(['status' => __($status)])

            : back()->withErrors([
                'email' => __($status)
            ]);

    })->name('password.email');


    // FORMULARIO NUEVA CONTRASEÑA
    Route::get('/reset-password/{token}', function (string $token) {

        return view('auth.reset-password', [

            'token' => $token

        ]);

    })->name('password.reset');


    // GUARDAR NUEVA CONTRASEÑA
    Route::post('/reset-password', function (Request $request) {

        $request->validate([

            'token' => 'required',

            'email' => 'required|email',

            'password' => 'required|min:6|confirmed'

        ]);

        $status = Password::reset(

            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),

            function ($user, $password) {

                $user->forceFill([

                    'password' => bcrypt($password)

                ])->save();

            }

        );

        return $status === Password::PASSWORD_RESET

            ? redirect('/login')->with(
                'status',
                'Contraseña actualizada correctamente'
            )

            : back()->withErrors([
                'email' => [__($status)]
            ]);

    })->name('password.update');

});


// DASHBOARD PRODUCTOR
Route::get('/productor/dashboard', function () {

    return view('productor.dashboard');

})->middleware(['auth.custom', 'role:productor']);


// DASHBOARD CLIENTE
Route::get('/cliente/dashboard', function () {

    return view('cliente.dashboard');

})->middleware(['auth.custom', 'role:cliente']);


// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth.custom');