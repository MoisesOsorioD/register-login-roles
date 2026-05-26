@extends('layouts.app')

@section('content')

<div class="text-center mt-5">

    <h1 class="display-4 fw-bold mb-3">

        Sistema Agrícola

    </h1>

    <p class="lead mb-4">

        Plataforma para clientes y productores agrícolas

    </p>

    @auth

        <div class="mb-3">

            <h4>

                Bienvenido {{ Auth::user()->name }}

            </h4>

        </div>

        <a
            href="/dashboard"
            class="btn btn-success me-2"
        >
            Ir al Dashboard
        </a>

        <form
            action="/logout"
            method="POST"
            class="d-inline"
        >

            @csrf

            <button class="btn btn-danger">

                Cerrar Sesión

            </button>

        </form>

    @endauth

    @guest

        <a
            href="/login"
            class="btn btn-primary me-2"
        >
            Iniciar Sesión
        </a>

        <a
            href="/register"
            class="btn btn-success"
        >
            Registrarse
        </a>

    @endguest

</div>

@endsection