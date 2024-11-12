<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Votaciones Activas</title>
</head>

<body>
    <!-- Header -->
    @include('admin.partials.header')
    <div class="content_">
        <!-- Links -->
        @include('admin.partials.ae-navigation')

        <div class="sec2">
            <b>Votaciones Activas</b>
            @foreach ($votacion as $voto)
                @if ($voto->ESTADO == 1)
                    <div class="space-y-6  card-voto">
                        <div class="bg-white shadow-md rounded p-4 border">
                            @csrf
                            <input type="hidden" name="sigla" value="{{ $voto->SIGLA }}">

                            <div class="flex justify-between items-center">
                                <div class="font-bold text-xl">Tema de la Votación: {{ $voto->NOMBRE }}</div>
                                <div class="text-gray-600">Fecha Inicio: {{ \Carbon\Carbon::parse($voto->created_at)->format('d-m-Y') }}</div>
                            </div>
                            <p class="text-gray-700 my-4">Descripción: {{ $voto->DESCRIPCION }}</p>
                            <div class="display">
                                <button type="button" class="collapsible"> <b> ▼ </b> </button>
                                <div class="content collapsible-content">
                                    <table>
                                        <tr>
                                            <th>Sigla</th>
                                            <th>Opci&oacute;n 1</th>
                                            <th>Opci&oacute;n 2</th>
                                            <th>Opci&oacute;n 3</th>
                                            <th>Opci&oacute;n 4</th>
                                            <th>Estado</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $voto->SIGLA }}</td>
                                            <td>
                                                <div class="count-votos">
                                                    {{ $voto->OPC_1 }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="count-votos">
                                                    {{ $voto->OPC_2 }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="count-votos">
                                                    @if(!empty($voto->OPC_3))
                                                        {{ $voto->OPC_3 }}
                                                        @else
                                                            <p> Sin opci&oacute;n </p>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="count-votos">
                                                    @if(!empty($voto->OPC_4))
                                                        {{ $voto->OPC_4 }}
                                                        @else
                                                            <p> Sin opci&oacute;n </p>
                                                    @endif
                                                </div>
                                            </td>
                                            @if ($voto->ESTADO == 1)
                                                <td>Activa</td>
                                                @else
                                                <td>Finalizada</td>
                                            @endif
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="flex justify-between" style=" margin: 20px 30px 0;">
                                <form action="{{ route('admin.ae-detalles-votacion', $voto->SIGLA)}}" method="POST">
                                    @csrf
                                    <button class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600" type="submit">M&aacute;s detalles</button>
                                </form>
                                    
                                <form action="{{ route('admin.finalizar-votacion', $voto->SIGLA) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas finalizar la votación?');">
                                @csrf
                                <select id="opc_ganadora" name="opc_ganadora" required class="border-gray-300 rounded-md">
                                    <option value="">Seleccione una opción ganadora </option>
                                    @if(!empty($voto->OPC_1))
                                        <option value="{{ $voto->OPC_1 }}">{{ $voto->OPC_1 }}</option>
                                    @endif

                                    @if(!empty($voto->OPC_2))
                                        <option value="{{ $voto->OPC_2 }}">{{ $voto->OPC_2 }}</option>
                                    @endif

                                    @if(!empty($voto->OPC_3))
                                        <option value="{{ $voto->OPC_3 }}">{{ $voto->OPC_3 }}</option>
                                    @endif

                                    @if(!empty($voto->OPC_4))
                                        <option value="{{ $voto->OPC_4 }}">{{ $voto->OPC_4 }}</option>
                                    @endif
                                </select>
                                    <button class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600" type="submit">Finalizar</button>
                                </form>

                                <!-- <div>
                                    <button onclick="openModal('{{ $voto->OPC_1 }}', '{{ $voto->OPC_2 }}', '{{ $voto->OPC_3 ?? '' }}', '{{ $voto->OPC_4 ?? '' }}')" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600" type="button">Finalizar</button>
                                </div> -->


                            </div>
                        </div>
                    </div>
                    @else
                @endif

            @endforeach
        </div>


        <!-- Modal -->
        <div id="myModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
            <form class="bg-white w-96 p-6 rounded-lg shadow-lg relative" action="{{ route('admin.finalizar-votacion', $voto->SIGLA) }}"
             method="POST" onsubmit="return confirm('¿Estás seguro de que deseas finalizar la votación?');">
            @csrf
                <button onclick="closeModal2()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">
                    &times;
                </button>
                <h2 class="text-xl font-semibold mb-4">Título del Modal</h2>
                    <label for="opc_ganadora" class="text-gray-700">Selecciona la opción ganadora:</label>
                    <select id="opc_ganadora" name="opc_ganadora" required class="border-gray-300 rounded-md">
                        <option value="">Seleccione una opción </option>
                    </select>
                <button onclick="closeModal2()" class="bg-blue-500 text-white px-4 py-2 rounded">Cancelar</button>
                <button class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600" type="submit">Finalizar</button>
            </form>
        </div>

        <script>
        function openModal() {
            document.getElementById('myModal').classList.remove('hidden');
        }

        function closeModal2() {
            document.getElementById('myModal').classList.add('hidden');
        }

        function openModal(opc1, opc2, opc3 = '', opc4 = '') {
            // Obtener el elemento del select
            const selectElement = document.getElementById('opc_ganadora');
            
            // Limpiar opciones anteriores (excepto la primera opción)
            selectElement.innerHTML = '<option value="">Seleccione una opción</option>';
            
            // Agregar opciones al select
            if (opc1) selectElement.innerHTML += `<option value="${opc1}">${opc1}</option>`;
            if (opc2) selectElement.innerHTML += `<option value="${opc2}">${opc2}</option>`;
            if (opc3) selectElement.innerHTML += `<option value="${opc3}">${opc3}</option>`;
            if (opc4) selectElement.innerHTML += `<option value="${opc4}">${opc4}</option>`;

            // Mostrar el modal
            document.getElementById('myModal').classList.remove('hidden');
        }

        function closeModal2() {
            document.getElementById('myModal').classList.add('hidden');
        }
    </script>

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

    </div>


</body>

</html>

<style>

    body {
        background-color: #F1F1F1;
    }

    .content_ {
        width: 100%;
        display: flex;
        justify-content: center;
        padding: 20px;
    }

    .sec2 {
        width: 90%;
        padding: 20px;
        border-radius: 10px;
        border: solid 1px #000;
        display: flex;
        flex-direction: column;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .sec2 > b {
        text-align: center;
        font-size: 28px;
        margin-bottom: 20px;
    }

    .card-voto{
        margin: 10px 0;
    }

    .display{
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    .collapsible {
        align-items: center;
        width: 30px; 
        height: 30px;
        padding: 0;
        border: solid #333;
        border-radius: 10px;
        font-weight: bold;
        text-align: center;
        font-size: 18px; /* Tamaño del ícono */
        transition: background-color 0.3s, transform 0.3s;
        color: #333;
    }

    .active, .collapsible:hover {
        background-color: #777;
    }

    .content.collapsible-content {
        display: none;
        background-color: #f1f1f1;
        border-radius: 10px;
        max-width: 100%;
        overflow-x: auto;
        margin: 10px 0 0;
    }

    .error-messages {
        color: red;
        margin-top: 20px;
    }

    .buttons{
        display: flex;
        justify-content: space-between;
        margin-top:20px;
        padding:0 80px;
    }

    /* Tabla */
    
    table {
        width: auto;
        border-collapse: collapse;
        margin: 0;
        overflow-x: auto;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .count-votos{
        display: flex;
        flex-direction: column;
        padding: 0 5px;
        width: 120px;
    }

    @media (max-width: 900px) {
        .buttons{
            display: flex;
            justify-content: space-between;
            margin-top:20px;
            padding:0 40px;
        }
    }

    @media (max-width: 600px) {
        body {
            background-color: #F1F1F1;
        }

        .content_ {
            width: 100%;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .sec2 {
            width: 90%;
            padding: 20px;
            border-radius: 10px;
            border: solid 1px #000;
            display: flex;
            flex-direction: column;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .sec2 > b {
            text-align: center;
            font-size: 22px;
            margin-bottom: 20px;
        }

        .display {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .collapsible {
            align-items: center;
            width: 30px; 
            height: 30px;
            padding: 0;
            border: solid #333;
            border-radius: 10px;
            font-weight: bold;
            text-align: center;
            font-size: 18px;
            transition: background-color 0.3s, transform 0.3s;
            color: #333;
        }

        .active, .collapsible:hover {
            background-color: #777;
        }

        .content.collapsible-content {
            display: none;
            background-color: #f1f1f1;
            border-radius: 10px;
            max-width: 100%;
            overflow-x: auto;
            margin: 10px 0 0;
        }

        .buttons {
            /* display: flex;
            flex-direction: column; */
            gap: 10px;
            margin-top: 10px;
            padding: 0;
        }

        table {
            width: auto;
            border-collapse: collapse;
            margin: 0;
            overflow-x: auto;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .count-votos {
            padding: 0 5px;
            width: 95px;
        }
    }

    @media (max-width: 400px) {

        th, td {
            padding: 6px 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .count-votos {
            padding: 0 5px;
            width: 95px;
        }
    }

    /* End CSS Tabla */

</style>

<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            var icon = this.querySelector("b");

            if (content.style.display === "block") {
                content.style.display = "none";
                icon.textContent = "▼"; 
            } else {
                content.style.display = "block";
                icon.textContent = "▲"; 
            }
        });
    }

    // Mesaje
    function closeModal() {
        document.querySelector('.fixed').style.display = 'none';
        }

</script>


