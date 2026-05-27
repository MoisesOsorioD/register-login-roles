@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-body p-4">

                <h2 class="mb-4">
                    Nueva Contraseña
                </h2>

                <form action="/reset-password" method="POST">

                    @csrf

                    <input
                        type="hidden"
                        name="token"
                        value="{{ $token }}"
                    >

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

                    <div class="mb-3">

                        <label class="form-label">
                            Nueva Contraseña
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                        >

                        @error('password')

                            <div class="text-danger mt-1">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Confirmar Contraseña
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                        >

                    </div>

                    <button class="btn btn-success w-100">

                        Cambiar contraseña

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection