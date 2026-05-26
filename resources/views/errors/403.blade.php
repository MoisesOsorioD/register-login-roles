@extends('layouts.app')

@section('content')

<div class="text-center mt-5">

    <h1
        class="display-1 fw-bold text-danger"
    >
        403
    </h1>

    <h2 class="mb-4">

        Acceso Denegado

    </h2>

    <p class="lead mb-4">

        No tienes permiso para entrar a esta página.

    </p>

    <a
        href="/dashboard"
        class="btn btn-primary"
    >
        Volver al Dashboard
    </a>

</div>

@endsection