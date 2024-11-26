<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Datos de la Votación</title>
</head>

<body>
    <!-- Header -->
    @include('admin.partials.header')  
    <div class="content">
        <!-- Links -->
        @include('admin.partials.ae-navigation') 
        <form class="sec2" action="{{ route('votacion.store') }}"  method="POST">
            <b class="text-center mb-4">Datos de la Votación</b>
            @csrf 
            <!-- Campo para el tema de la votación -->
            <div class="form-group">
                <label for="tema">Tema de la Votación:</label>
                <input type="text" class="form-control" id="tema" name="tema" placeholder="Ingrese el tema" maxlength="60" required>
            </div>
                <!-- Campo para SIGLA -->
            <div class="form-group">
                <label for="sigla">SIGLA:</label>
                <input type="text" class="form-control" id="sigla" name="sigla" placeholder="Ingrese la SIGLA" maxlength="12" required>
            </div>
            <!-- Campo para la descripción -->
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingrese la descripción"  maxlength="300" required></textarea>
            </div>
            <!-- Campo para la opción 1 -->
            <div class="form-group">
                <label for="opcion1">Opción 1:</label>
                <input type="text" class="form-control" id="opcion1" name="opcion1" placeholder="Ingrese la opción 1" maxlength="30" required>
            </div>
            <!-- Campo para la opción 2 -->
            <div class="form-group">
                <label for="opcion2">Opción 2:</label>
                <input type="text" class="form-control" id="opcion2" name="opcion2" placeholder="Ingrese la opción 2" maxlength="30" required>
            </div>
            <!-- Campo para la opción 3 -->
            <div class="form-group">
                <label for="opcion3">Opción 3:</label>
                <input type="text" class="form-control" id="opcion3" name="opcion3" placeholder="Ingrese la opción 3" maxlength="30">
            </div>
            <!-- Campo para la opción 4 -->
            <div class="form-group">
                <label for="opcion4">Opción 4:</label>
                <input type="text" class="form-control" id="opcion4" name="opcion4" placeholder="Ingrese la opción 4" maxlength="30">
            </div>
            <!-- Botón para enviar el formulario -->
            <button type="submit" class="btn btn-primary btn-block">Iniciar Votación</button>
                <!-- <button type="button" class="btn btn-secondary mt-2">+</button> -->
        </form>

        @if(session('success'))
            <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
                    <h2 class="text-2xl font-semibold mb-4 text-green-600">¡Éxito!</h2>
                    <p class="mb-4">{{ session('success') }}</p>
                    <button onclick="closeModal()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Cerrar</button>
                </div>
            </div>
        @endif
        @if (session('error'))
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
    </div>

</body>
</html>


<style>
        * {
            padding: 0;
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }

        body {
            height: 90vh;
        }

        .content {
            height: auto;
            width: 100%;
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

        .sec2 > b {
            text-align: center;
            font-size: 40px;
            margin-bottom: 10px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            padding: 10px;
            margin-top: 5px;
            width: 100%; /* Asegura que el input ocupe todo el ancho */
        }

        .btn {
            background-color: #FFBD58;
            color: white;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
        }

        .btn-secondary {
            background-color: #FFBD58;
            color: white;
            margin-top: 10px;
        }

        .btn-secondary:hover {
            background-color: #e6a846;
        }

        .btn-block {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
        }


    /* Estilos para el modal */

    .fixed {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

</style>

<script>
    function closeModal() {
        document.querySelector('.fixed').style.display = 'none';
    }
</script>