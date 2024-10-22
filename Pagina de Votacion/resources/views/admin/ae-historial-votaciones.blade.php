<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Historial de Votaciones</title>
</head>

<body>
    <!-- Header -->
    @include('admin.partials.header')
    <div class="content_">
        <!-- Links -->
        @include('admin.partials.ae-navigation')

        <div class="sec2">
            <b>Historial de Votaciones</b>
            @foreach ($votacion as $voto)
                @if ($voto->ESTADO == 0)
                    <div class="card">
                        <div class="card_title">
                            <div class="titulo">
                                <p>Tema de la votación: </p>
                                <p class="sub-title">{{ $voto->NOMBRE }}</p>
                            </div>
                            <div class="fechas">
                                <p>Fecha de inicio: {{ \Carbon\Carbon::parse($voto->created_at)->format('d-m-Y') }} </p>
                                <p>Fecha de Termino: {{ \Carbon\Carbon::parse($voto->updated_at)->format('d-m-Y') }} </p>
                            </div>
                        </div>
                        <div class="display">
                            <button type="button" class="collapsible"> <b> ▼ </b> </button>
                            <div class="content collapsible-content">
                                <table>
                                    <tr>
                                        <th>Sigla</th>
                                        <th>Tema</th>
                                        <th>Descripci&oacute;n</th>
                                        <th>Opci&oacute;n 1</th>
                                        <th>Opci&oacute;n 2</th>
                                        <th>Opci&oacute;n 3</th>
                                        <th>Opci&oacute;n 4</th>
                                        <th>Votos Totales</th>
                                        <th>Estado</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $voto->SIGLA }}</td>
                                        <td>{{ $voto->NOMBRE }}</td>
                                        <td>{{ $voto->DESCRIPCION }}</td>
                                        <td>{{ $voto->OPC_1 }}</td>
                                        <td>{{ $voto->OPC_2 }}</td>
                                        <td>{{ $voto->OPC_3 }}</td>
                                        <td>{{ $voto->OPC_4 }}</td>
                                        <td></td>
                                        @if ($voto->ESTADO == 1)
                                            <td>Activa</td>
                                            @else
                                            <td>Finalizada</td>
                                        @endif
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <form class="buttons" action="{{ route('admin.ae-detalles-votacion', $voto->SIGLA)}}" method="POST">
                            @csrf
                            <button type="submit">
                                M&aacute;s detalles
                            </button>
                        </form>
                    </div>
                    @else
                @endif

            @endforeach
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
        @endif
    </div>


</body>

</html>

<style>

    body {
        background-color: #F1F1F1;
    }

    .content_ {
        height:auto;
        width: 100%;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items:center;
        padding: 20px;
    }

    .sec2 {
        height:auto;
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

    .card {
        margin: 10px 0;
        padding: 13px 10px;
        margin-bottom: 30px;
        border-radius: 10px;
        border: solid 1px #000;
        display: flex;
        flex-direction: column;
        background-color: #f9f9f9;
        transition: background-color 0.3s;
    }

    .card_title{
        display:flex;
        justify-content:space-between;
        padding: 8px 12px;
    }

    .titulo>p{
        font-size: 22px;
    }

    .sub-title{
        margin-left: 50px;
    }

    .titulo>.sub-title{
        font-size: 30px;
    }
    
    .fechas{
        font-size: 18px;
        padding-right: 5px;
        text-align: right;
    }
    .card:hover {
        background-color: #f1f1f1;
    }

    .display{
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    .collapsible {
        align-items: center;
        width: 30px; /* Ajustado para que se vea bien con los íconos */
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
    }

    .error-messages {
        color: red;
        margin-top: 20px;
    }

    .buttons{
        display: flex;
        justify-content: start;
        margin-top:20px;
        padding:0 80px;
    }

    .buttons>button{
        background-color: green;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    .buttons>,button:hover {
        background-color: darkgreen;
    }

    /* Tabla */
    

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    /* End CSS Tabla */


    @media (max-width: 400px) {
        .titulo>.sub-title{
            font-size: 24px;
        }
    }

    @media (max-width: 768px) {
        .titulo>.sub-title{
            font-size: 24px;
        }
    }

    @media (max-width: 900px) {
        .titulo>.sub-title{
            font-size: 24px;
            margin: 0;
        }

        .buttons{
            display: flex;
            justify-content: space-between;
            margin-top:20px;
            padding:0 40px;
        }
    }

    @media (max-width: 1100px) {
        .titulo>.sub-title{
            font-size: 26px;
        }
    }
    /* Ajustes CSS para móviles */
    @media (max-width: 600px) {
        .card_title {
            flex-direction: column;
            padding: 8px 0;
        }

        .titulo > p {
            font-size: 16px;
        }

        .sub-title {
            font-size: 20px;
            margin-left: 0;
        }

        .fechas {
            font-size: 14px;
            text-align: left;
        }

        .buttons {
            padding: 0;
            flex-direction: column;
            gap: 10px;
            width: 100%;
            align-items: center;
        }

        table {
            width: 100%;
            overflow-x: auto;
        }

        th, td {
            padding: 10px;
            font-size: 14px;
        }

        .collapsible {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
    }

    @media (max-width: 400px) {
        .titulo > p {
            font-size: 14px;
        }

        .fechas {
            font-size: 12px;
        }

        .buttons button {
            padding: 8px 12px;
            font-size: 12px;
        }

        th, td {
            padding: 8px;
            font-size: 12px;
        }
    }


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
                icon.textContent = "▼"; // Flecha hacia abajo cuando la tabla está oculta
            } else {
                content.style.display = "block";
                icon.textContent = "▲"; // Flecha hacia arriba cuando la tabla está visible
            }
        });
    }

    // Mensaje 
    function closeModal() {
    document.querySelector('.fixed').style.display = 'none';
    }
</script>


