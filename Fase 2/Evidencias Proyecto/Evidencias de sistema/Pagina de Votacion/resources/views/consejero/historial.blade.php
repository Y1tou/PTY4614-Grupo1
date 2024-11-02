<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <title>Historial de Votaciones</title>
</head>

<body>
    @include('consejero.partials.header')
    <div class="content">
        @include('consejero.partials.navigation')
        <main id="miMain" class="p-6 flex-grow">
            <h1 class="text-2xl font-bold mb-6">Historial de Votos Realizados</h1>
            <div class="space-y-6 card-voto">
                @foreach ($votacionesConVotos as $votacion)
                    <div class="bg-white shadow-md rounded p-4 border">
                        <div class="flex justify-between items-center">
                            <div class="font-bold text-xl">Tema de la Votación: {{ $votacion->NOMBRE }}</div>
                            <div>
                                <div class="text-gray-600">Fecha Inicio: {{ \Carbon\Carbon::parse($votacion->created_at)->format('d-m-Y') }}</div>
                                <div class="text-gray-600">Fecha Termino: {{ \Carbon\Carbon::parse($votacion->updated_at)->format('d-m-Y') }}</div>
                            </div>
                        </div>
                        <p class="text-gray-700 my-4">Descripción: {{ $votacion->DESCRIPCION }}</p>
                        <div class="flex items-center space-x-4">
                            <label class="text-gray-700">Opción Seleccionada:</label>
                            <span class="text-gray-700">{{ $votacion->opcion_votada }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
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