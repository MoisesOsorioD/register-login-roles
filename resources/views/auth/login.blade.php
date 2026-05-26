@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-body">

                <h2 class="mb-4">
                    Login
                </h2>

                <form action="/login" method="POST">

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

                    <div class="mb-4">

                        <label class="form-label">
                            Contraseña
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

                    <div class="mb-3 form-check">

                        <input
                            type="checkbox"
                            name="remember"
                            class="form-check-input"
                            id="remember"
                        >

                        <label
                            class="form-check-label"
                            for="remember"
                        >
                            Recordarme
                        </label>

                    </div>

                    <button class="btn btn-success w-100">

                        Iniciar Sesión

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection