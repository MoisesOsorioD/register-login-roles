@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-body">

                <h2 class="mb-4">
                    Registro
                </h2>

                <form action="/register" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Nombre
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control"
                        >

                        @error('name')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

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

                    <div class="mb-4">

                        <label class="form-label">
                            Rol
                        </label>

                        <select
                            name="role"
                            class="form-select"
                        >

                            <option
                                value="cliente"
                                {{ old('role') == 'cliente' ? 'selected' : '' }}
                            >
                                Cliente
                            </option>

                            <option
                                value="productor"
                                {{ old('role') == 'productor' ? 'selected' : '' }}
                            >
                                Productor Agrícola
                            </option>

                        </select>

                        @error('role')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <button class="btn btn-success w-100">

                        Registrarse

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection