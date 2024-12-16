<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Administrador</title>
</head>

<body>
    <header>
        <div class="logo">
            <strong style="color: #F1F1F1;">Duoc</strong>
            <strong style="color: #FFBD58;">UC</strong>
            <p style="color: #F1F1F1;">Consejeros</p>
        </div>

        <a href="/">
            Login Users
        </a>

    </header>

<!-- Verificar el uso correcto del form action -->
    <form action="{{ url('/admin/login') }}" method="post">
        @csrf
        <div class="header_form">
            <p>Bienvenido</p>
        </div>

        <div class="container">
            <label for="CORREO"><b>Correo</b></label>
            <input type="email" placeholder="Ingresar Correo" name="CORREO" required>

            <label for="CONTRASENIA"><b>Contrase&ntilde;a</b></label>
            <input type="password" placeholder="Ingresar Contrase&ntilde;a" name="CONTRASENIA" required>

            <button type="submit">Ingresar al portal</button>
        </div>

    </form>
        @if ($errors->any())
            <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
                    <h2 class="text-2xl font-semibold mb-4 text-green-600">Éxito</h2>
                    @foreach ($errors->all() as $error)
                    <p class="mb-4"><li>{{ $error }}</li></p>
                    @endforeach
                    <button onclick="closeModal()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Cerrar</button>
                </div>
            </div>
        @endif

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
            margin: 10% 25% 0% 25%;
            border-radius: 5px;
            border-color: #ccc;
        }
    
        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 18px;
        }
    
        button {
            background-color: #FFFFFF;
            color: #1c1c1c;
            padding: 14px 20px;
            margin: 25px 0;
            border-radius: 10px;
            border-color: #ccc;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }
    
        button:hover {
            opacity: 0.9;
            background-color: #ffbc58;
        }
    
        .header_form {
            text-align: center;
            font-size: 30px;
            margin: 24px 0 12px 0;
        }
    
        .container {
            padding: 16px;
        }
        b{
            font-size: 20px;
        }

        @media (max-width: 700px) {
            form {

                margin: 15% 10% 0% 10%;
                border-radius: 5px;
                border-color: #ccc;
            }
            
            button {
                padding: 10px 16px;
                margin: 15px 0;
                font-size: 18px;
            }
            
            input[type=email],
            input[type=password] {
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
    </style>

<script>
    function closeModal() {
        document.querySelector('.fixed.inset-0').style.display = 'none';
    }
</script>


