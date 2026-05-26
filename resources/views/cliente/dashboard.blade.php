@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-body">

        <h1 class="mb-3">
            Dashboard Cliente
        </h1>

        <p>
            Bienvenido cliente.
        </p>

        <form action="/logout" method="POST">

            @csrf

            <button class="btn btn-danger">

                Cerrar sesión

            </button>

        </form>

    </div>

</div>

@endsection