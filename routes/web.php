<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Enums\RoleEnum;

// RUTA INICIO
Route::get('/', function () {

    return view('welcome');

});


// DASHBOARD AUTOMÁTICO
// Decide dashboard según rol del usuario autenticado
Route::get('/dashboard', function () {

    if (Auth::user()->role == RoleEnum::PRODUCTOR->value) {

        return redirect('/productor/dashboard');

    }

    return redirect('/cliente/dashboard');

})->middleware('auth.custom');


// RUTAS GUEST
// Solo usuarios NO autenticados pueden acceder a estas rutas
Route::get('/register', [AuthController::class, 'showRegister'])
    ->middleware('guest.custom');

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest.custom');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->middleware('guest.custom');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest.custom');


// DASHBOARD PRODUCTOR
Route::get('/productor/dashboard', function () {

    return view('productor.dashboard');

})->middleware(['auth.custom', 'role:productor']);


// DASHBOARD CLIENTE
Route::get('/cliente/dashboard', function () {

    return view('cliente.dashboard');

})->middleware(['auth.custom', 'role:cliente']);


Route::get('/cliente/dashboard', function () {

    return view('cliente.dashboard');

})->middleware(['auth.custom', 'role:cliente']);


// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth.custom');