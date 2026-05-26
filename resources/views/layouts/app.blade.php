@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema Agrícola</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-light">

    <!-- NAVBAR -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-success">

        <div class="container">

            <a
                class="navbar-brand fw-bold"
                href="/"
            >
                Sistema Agrícola
            </a>

            <div class="d-flex align-items-center">

                <a
                    href="/"
                    class="btn btn-outline-light me-2"
                >
                    Inicio
                </a>

                @guest

                    <a
                        href="/login"
                        class="btn btn-light me-2"
                    >
                        Login
                    </a>

                    <a
                        href="/register"
                        class="btn btn-warning"
                    >
                        Registro
                    </a>

                @endguest

                @auth

                    <a
                        href="/dashboard"
                        class="btn btn-light me-2"
                    >
                        Dashboard
                    </a>

                    <span class="text-white me-3">

                        {{ Auth::user()->name }}

                    </span>

                    <form
                        action="/logout"
                        method="POST"
                    >

                        @csrf

                        <button class="btn btn-danger">

                            Logout

                        </button>

                    </form>

                @endauth

            </div>

        </div>

    </nav>

    <!-- CONTENIDO -->

    <div class="container mt-5">

        @yield('content')

    </div>

</body>

</html>