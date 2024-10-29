<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <title>Document</title>
</head>

<body>
    @include('consejero.partials.header')
    <div class="content">
        <!-- Links -->
        @include('consejero.partials.navigation')
        <!-- Votaciones disponibles -->
        <main id="miMain" class="sec2 p-6 flex-grow">
            <h1 class="text-2xl font-bold mb-6">Lista de Votaciones Disponibles</h1>

            <div class="space-y-6">
                <!-- Card de votación -->
                <form class="bg-white shadow-md rounded p-4 border" action="" method="POST">
                    <div class="flex justify-between items-center">
                        <div class="font-bold text-xl">Tema de la Votación: Jardín de la sede</div>
                        <div>
                            <div class="text-gray-600">Fecha Inicio: 05 / 09 / 2024</div>
                            <div class="text-gray-600">Fecha Termino: 05 / 09 / 2024</div>
                        </div>
                    </div>
                    <p class="text-gray-700 my-4">
                        Descripción: Lorem ipsum dolor sit amet consectetur adipiscing elit laoreet aenean, ultrices
                        phasellus nam euismod taciti dictumst suscipit conubia..
                    </p>
                    <div class="flex items-center space-x-4">
                        <label class="text-gray-700">Opción Seleccionada:</label>
                        <input type="text" name="opc" placeholder="OPC 1" disabled>
                    </div>
                </form>
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