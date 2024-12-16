<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>A.E. Home</title>
</head>

<body>
    <!-- Header -->
    @include('admin.partials.header')
    <div class="content">
        <!-- Links -->
        @include('admin.partials.ae-navigation')
            <form class="sec2" action="{{ route('register') }}" method="POST">
                <b>Registrar Consejero de carrera</b>
                @csrf
                <input type="text" name="run" placeholder="RUT (Sin punto y/o gui&oacute;n )" minlength="7" maxlength="8" required>
                <input type="text" name="name" placeholder="Nombre" required>
                <input type="email" name="email" placeholder="Correo electrónico *" required>
                <input type="text" name="carrera" placeholder="Carrera" required>
                <input type="number" name="edad" placeholder="Edad" required min="18">
                <select name="sexo" required>
                    <option value="">Selecciona Sexo</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
                <button type="submit">Registrar</button>
            </form>
    </div>
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
    @elseif (session('error'))
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
                <h2 class="text-2xl font-semibold mb-4 text-red-600">Mensaje</h2>
                    <p class="mb-4">
                        <li>{{ session('error') }}</li>
                    </p>
                <button onclick="closeModal()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Cerrar</button>
            </div>
        </div>
    @endif
</body>

</html>

<style>

    .content {
        height: 100%;
        width: 100%;
        background-color: #F1F1F1;
        display: flex;
        justify-content: center;
    }

    .sec2 {
        height: 60%;
        width: 80%;
        margin: 5%;
        padding: 5% 10%;
        border-radius: 10px;
        border: solid #000;
        display: flex;
        justify-content: center;
        flex-direction: column;
        background-color: #F1F1F1;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

    @media (max-width: 768px) {
        .sec2 {
            height: 60%;
            width: 100%;
            margin: 5%;
            padding: 5%;
            border-radius: 10px;
            border: none;
            display: flex;
            justify-content: center;
            flex-direction: column;
            background-color: #F1F1F1;
            box-shadow: none;
        }

        .sec2>b {
            font-size: 32px;
        }
        
        select option {
            font-size: 16px;
        }
    }

</style>

<script>

    document.querySelector('form.sec2').addEventListener('submit', function(e) {
        const runInput = document.querySelector('input[name="run"]');
        const runValue = runInput.value;
        const emailInput = document.querySelector('input[name="email"]');
        const emailValue = emailInput.value;
        

        // Validar que el campo `run` contenga solo números
        if (!/^\d+$/.test(runValue)) {
            e.preventDefault(); // Detener el envío del formulario
            alert("El campo RUT debe contener solo números.");
            return false;
        }

        // Validar que el campo `run` contenga solo números
        if (!/^[a-zA-Z]+(\.[a-zA-Z]+)?@duocuc\.cl$/.test(emailValue)) {
            e.preventDefault(); // Detener el envío del formulario
            alert("El correo debe terminar en @duocuc.cl");
            return false;
        }
    });


    // Mensaje 
    function closeModal() {
        document.querySelector('.fixed').style.display = 'none';
    }
</script>