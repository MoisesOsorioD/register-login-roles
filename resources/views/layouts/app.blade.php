<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AgroSistema</title>

    <!-- Bootstrap CSS CDN -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-success">

    <div class="container">

        <a class="navbar-brand" href="/">
            AgroSistema
        </a>

        <div>

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

                <span class="text-white me-3">

                    {{ Auth::user()->name }}

                    |

                    {{ Auth::user()->role }}

                </span>

                <form 
                    action="/logout"
                    method="POST"
                    class="d-inline"
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

    <main class="container mt-5">

        @yield('content')

    </main>

    <!-- Bootstrap JS CDN -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>