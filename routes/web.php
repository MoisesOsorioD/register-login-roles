<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| RUTA INICIO
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| RUTAS GUEST
|--------------------------------------------------------------------------
| Solo usuarios NO autenticados
*/

Route::get('/register', [AuthController::class, 'showRegister'])
    ->middleware('guest.custom');

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest.custom');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->middleware('guest.custom');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest.custom');

/*
|--------------------------------------------------------------------------
| DASHBOARD PRODUCTOR
|--------------------------------------------------------------------------
*/

Route::get('/productor/dashboard', function () {

    return view('productor.dashboard');

})->middleware(['auth.custom', 'role:productor']);

/*
|--------------------------------------------------------------------------
| DASHBOARD CLIENTE
|--------------------------------------------------------------------------
*/

Route::get('/cliente/dashboard', function () {

    return view('cliente.dashboard');

})->middleware(['auth.custom', 'role:cliente']);

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth.custom');