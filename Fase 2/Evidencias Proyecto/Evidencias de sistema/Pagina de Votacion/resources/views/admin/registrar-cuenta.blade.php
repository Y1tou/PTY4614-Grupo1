<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Administrador - Registro</title>
</head>

<body>    
    <!-- Header -->
    @include('admin.partials.header')
    <div class="content">
        <!--Links -->
        @include('admin.partials.navegation')

        <form class="sec2" action="{{ route('admin.registrar-cuenta') }}" method="POST">
            @csrf
            <b>Datos</b>

            <label for="NOMBRE"><b>Nombre</b></label>
            <input type="text" placeholder="Ingresar Nombre" name="NOMBRE">

            <label for="CORREO"><b>Correo *</b></label>
            <input type="email" placeholder="Ingresar Correo" name="CORREO" required>

            <label for="CONTRASENIA"><b>Contrase&ntilde;a</b></label>
            <input type="password" placeholder="Ingresar Contrase&ntilde;a" name="CONTRASENIA" id="CONTRASENIA" required>


            <label for="voto-select"><b>Elige una opción:</b></label>

            <select name="TIPO" id="voto-select" required>
                <option value="">Opciones</option>
                <option value="1">Tipo 1</option>
                <option value="2">Tipo 2</option>
            </select>

            <button type="submit">Registrar</button>
            @if ($errors->any())
                <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
                        <h2 class="text-2xl font-semibold mb-4 text-red-600">Mensaje</h2>
                        @foreach ($errors->all() as $error)
                            <p class="mb-4"><li>{{ $error }}</li></p>
                        @endforeach
                        <button onclick="closeModal()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Cerrar</button>
                    </div>
                </div>
            @endif

        </form>
    </div>

</body>

</html>

<style>

    .content {
        height: auto;
        width: 100%;
        background-color: #F1F1F1;
        display: flex;
        justify-content: center;
    }
    
    .sec2 {
        height: auto;
        width: 80%;
        margin: 5%;
        padding: 5% 12%;
        border-radius: 10px;
        border: solid;
        border-color: #000;
        display: flex;
        justify-content: center;
        flex-direction: column;
        background-color: #F1F1F1;
    }

    .sec2>b {
        text-align: center;
        font-size: 40px;
        margin-bottom: 10px;
    }

    label>b {
        font-size: 20px;
    }

    input,
    select {
        width: 100%;
        padding: 10px 10px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        font-size: 20px;
    }


    .sec2>button {
        background-color: #FFFFFF;
        color: #000;
        padding: 14px 20px;
        margin: 25px 0;
        border-radius: 10px;
        border-color: #000;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    .sec2>button:hover {
        background-color: #FFBD58;
        color: #FFFFFF;
    }

</style>

<script>
    document.getElementById('voto-select').addEventListener('change', function () {
        const passwordInput = document.getElementById('CONTRASENIA');
        if (this.value === '2') {
            passwordInput.disabled = true; 
            passwordInput.value = ''; 
            passwordInput.placeholder = "Contraseña no requerida"; 
            passwordInput.removeAttribute('required'); 
        } else {
            passwordInput.disabled = false;
            passwordInput.placeholder = "Ingresar Contraseña";
            passwordInput.setAttribute('required', 'required');
        }
    });

    // Mensaje 
    function closeModal() {
    document.querySelector('.fixed').style.display = 'none';
    }
</script>