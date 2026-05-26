@extends('layouts.app')

@section('content')

<div class="text-center mt-5">

    <h1 class="mb-3">

        Dashboard Cliente

    </h1>

    <h3 class="mb-4">

        Bienvenido {{ Auth::user()->name }}

    </h3>

    <p class="mb-4">

        Aquí podrás explorar productos agrícolas.

    </p>

    <form action="/logout" method="POST">

        @csrf

        <button class="btn btn-danger">

            Cerrar Sesión

        </button>

    </form>

</div>

@endsection