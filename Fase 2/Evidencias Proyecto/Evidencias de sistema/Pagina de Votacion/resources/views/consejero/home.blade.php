<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <title>Consejeros Home</title>
</head>

<body>
    @include('consejero.partials.header')
    <div class="content">
        <!-- Links -->
        @include('consejero.partials.navigation')
        <!-- Votaciones disponibles -->
        <main id="miMain" class="p-6 flex-grow">
            <h1 class="text-2xl font-bold mb-6">Lista de Votaciones Disponibles</h1>
            @foreach ($votacionesConVotos as $voto)
                <div class="space-y-6  card-voto">
                    <form class="bg-white shadow-md rounded p-4 border" action="{{ route('voto.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sigla" value="{{ $voto->SIGLA }}">

                        <div class="flex justify-between items-center">
                            <div class="font-bold text-xl">Tema de la Votación: {{ $voto->NOMBRE }}</div>
                            <div class="text-gray-600">Fecha Inicio: {{ \Carbon\Carbon::parse($voto->created_at)->format('d-m-Y') }}</div>
                        </div>
                        <p class="text-gray-700 my-4">Descripción: {{ $voto->DESCRIPCION }}</p>
                        @if($voto->voto_realizado)
                            <div class="flex items-center space-x-4">
                                <label class="text-gray-700">Opción Seleccionada:</label>
                                <span class="text-gray-700">{{ $voto->opcion_votada }}</span>
                            </div>
                        @else
                            <div class="flex items-center space-x-4">
                                <label for="opcion_votada" class="text-gray-700">Selecciona una opción:</label>
                                <select id="opcion_votada" name="opcion_votada" required class="border-gray-300 rounded-md">
                                    <option value="">Seleccione una opción</option>
                                    <option value="{{ $voto->OPC_1 }}">{{ $voto->OPC_1 }}</option>
                                    <option value="{{ $voto->OPC_2 }}">{{ $voto->OPC_2 }}</option>
                                    <option value="{{ $voto->OPC_3 }}">{{ $voto->OPC_3 }}</option>
                                    <option value="{{ $voto->OPC_4 }}">{{ $voto->OPC_4 }}</option>
                                </select>
                                <button type="submit" class="bg-blue-800 text-white px-4 py-1 rounded">Confirmar voto</button>
                            </div>
                        @endif
                    </form>
                </div>
            @endforeach
        </main>
    </div>
</body>

</html>


<style>

    body{
        background-color: #F1F1F1;
    }

    .content {
        height: 100%;
        width: 100%;
        background-color: #F1F1F1;
        display: flex;
        justify-content: center;
    }

    .card-voto{
        margin: 10px 0;
    }

    .sec2 {
        height: 60%;
        width: 100%;
        margin: 5%;
        padding: 2% 5%;
        border-radius: 10px;
        border: solid #000;
        display: flex;
        justify-content: center;
        flex-direction: column;
        background-color: #F1F1F1;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
    function handleResize() {
        const mainElement = document.getElementById('miMain');

        if (window.matchMedia('(max-width: 600px)').matches) {
            // Si la pantalla es menor o igual a 600px, quita la clase sec2
            mainElement.classList.remove('sec2');
        } else {
            // Si la pantalla es mayor a 600px, añade la clase sec2
            mainElement.classList.add('sec2');
        }
    }

    // Agregar el evento de resize
    window.addEventListener('resize', handleResize);

    // Llamar la función al cargar la página
    handleResize();

</script>