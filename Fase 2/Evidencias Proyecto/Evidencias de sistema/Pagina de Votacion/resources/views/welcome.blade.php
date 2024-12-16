<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header>
        <div class="logo">
            <strong style="color: #F1F1F1;">Duoc</strong>
            <strong style="color: #FFBD58;">UC</strong>
            <p style="color: #F1F1F1;">Consejeros</p>
        </div>

        <div>
            @if (Route::has('login'))
                <nav>
                    @auth
                        <a href="{{ url('/dashboard') }}">
                            Dashboard
                        </a>
                    @else
                        <a href="/admin">
                            Administrador
                        </a>
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <form action="{{ route('verificar.correo') }}" method="POST"> 
        @csrf
        <div class="header_form">
            <img src="{{ asset('images/Imagen1.png') }}" alt="IMG">
        </div>

        <div class="container">
            <input type="email" placeholder="Ingresar Correo" name="email" required>

            <button type="submit">Ingresar al portal</button>
        </div>
    </form>

    @if (isset($correoValido) && $correoValido)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
                <h2 class="text-2xl font-semibold mb-4 text-green-600">Éxito</h2>
                <p class="mb-4">Su cuenta es valida para acceder al sitio.</p>
                <a href="/google-auth/redirect" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-center block mx-auto">
                    Ingresar
                </a>
            </div>
        </div>
    @endif

    @if (isset($correoValido) && !$correoValido)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
                <h2 class="text-2xl font-semibold mb-4 text-red-600">Error</h2>
                <p class="mb-4">No tiene una cuenta registrada para acceso al sitio.</p>
                <button onclick="closeModal()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    Cerrar
                </button>
            </div>
        </div>
    @endif

    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: 'Roboto';
        }

        header {
            height: 10vh;
            width: 100%;
            background-color: #163D64;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        a {
            color: #FFFFFF;
            text-decoration: inherit;
            margin-right: 50px;
        }

        .logo {
            width: 22%;
            height: 100%;
            display: flex;
            text-align: start;
            margin-left: 1vh;
            align-items: center;
        }

        .logo>strong {
            font-size: 40px;
            text-decoration: none;
            font-family: 'Roboto';
        }

        .logo>p {
            font-size: 45px;
            font-family: 'Brush Script MT', cursive;
            text-decoration: none;
        }

        /*Form */
        form {
            border: 3px solid #f1f1f1;
            background-color: #EBEBEB;
            margin: 6% 25% 0% 25%;
            border-radius: 5px;
            border-color: #ccc;
        }

        input[type=email] {
            width: 100%;
            padding: 20px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 20px;
        }

        button {
            background-color: #FFBD58;
            color: #FFFFFF;
            padding: 14px 20px;
            margin: 25px 0;
            border-radius: 10px;
            border-color: #edc486;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        button:hover {
            background-color: #ffaf37;
        }

        .header_form {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        .container {
            padding: 16px;
        }

        b {
            font-size: 20px;
        }

        .acceso {
            display: flex;
            justify-content: center;
        }
        .header_form img {
            max-width: 100%; /* Asegura que la imagen no desborde el contenedor */
            height: auto; /* Mantiene la relación de aspecto */
            margin: 0 auto; /* Centra la imagen */
        }

        @media (max-width: 700px) {
            form {

                margin: 15% 10% 0% 10%;
                border-radius: 5px;
                border-color: #ccc;
            }
            .header_form img {
                max-width: 40%; /* Asegura que la imagen no desborde el contenedor */
                height: auto; /* Mantiene la relación de aspecto */
                margin: 0 auto; /* Centra la imagen */
            }
            
            button {
                padding: 10px 16px;
                margin: 15px 0;
                font-size: 18px;
            }
            
            input[type=email] {
                padding: 10px 16px;
                margin: 6px 0;
                font-size: 18px;
            }
                a {
                margin-right: 10px;
                font-size: 12px;
            }

        @media (max-width: 1100px) {  

            .btn-log{
                display: none;
            }

            .logo>strong {
                font-size: 35px;
                text-decoration: none;
                font-family: 'Roboto';
            }

            .logo>p {
                font-size: 40px;
                font-family: 'Brush Script MT', cursive;
                text-decoration: none;
            }
        }

        @media (max-width: 400px){

            header {
                height: 8vh;
            }

            .logo>strong {
                font-size: 30px;
                text-decoration: none;
                font-family: 'Roboto';
            }

            .logo>p {
                font-size: 35px;
                font-family: 'Brush Script MT', cursive;
                text-decoration: none;
            }
        }
    }
    </style>

    <script>
        function closeModal() {
            document.querySelector('.fixed.inset-0').style.display = 'none';
        }
    </script>
</body>

</html>
