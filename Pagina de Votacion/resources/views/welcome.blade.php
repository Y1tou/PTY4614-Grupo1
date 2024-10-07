<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
        <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
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
                    <a href="/google-auth/redirect">
                        Iniciar sesion
                    </a>
                @endauth
            </nav>
        @endif
        </div>
    </header>

    <form action="action_page.php" method="post">
        <div class="header_form">
            <img src="" alt="">
        </div>

        <div class="container">
            <input type="email" placeholder="Ingresar Correo" name="email" required>
            <!-- <input type="password" placeholder="Ingresar Contrase&ntilde;a" name="psw" required> -->

            <button type="submit">Ingresar al portal</button>
        </div>

    </form>

</body>

</html>

<style>
    * {
        padding: 0%;
        margin: 0%;
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

    a{
        color: #FFFFFF;
        text-decoration: inherit;
        margin-right:50px;
    }

    .logo {
        width: 22%;
        height: 100%;
        display: flex;
        text-align: start;
        margin-left: 1vh;
        align-items: center;
    }
    .logo>strong{
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

    input[type=email],
    input[type=password]{
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
    b{
        font-size: 20px;
    }
</style>
