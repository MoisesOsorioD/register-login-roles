@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-body p-4">

                <h2 class="mb-4">
                    Recuperar Contraseña
                </h2>

                @if (session('status'))

                    <div class="alert alert-success">

                        {{ session('status') }}

                    </div>

                @endif

                <form action="/forgot-password" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Correo
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control"
                        >

                        @error('email')

                            <div class="text-danger mt-1">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <button class="btn btn-success w-100">

                        Enviar enlace

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection