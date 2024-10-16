<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                            <p>Tema de la votación: {{ $voto->NOMBRE }}</p>
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
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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

    .card_title>p{
        font-size: 22px;
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
        background-color: #777;
        padding: 0;
        font-weight: bold;
        text-align: center;
        font-size: 18px; /* Tamaño del ícono */
        transition: background-color 0.3s, transform 0.3s;
    }

    .active, .collapsible:hover {
        background-color: #555;
    }

    .content.collapsible-content {
        display: none;
        overflow: hidden;
        background-color: #f1f1f1;
        padding: 10px;
        border-radius: 5px;
    }

    .error-messages {
        color: red;
        margin-top: 20px;
    }

    .buttons{
        display: flex;
        justify-content: start;
        margin-top:20px;
        padding:0 10px;
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
        font-family: arial, sans-serif;
        border-collapse: collapse;
        /* height: 10%; */
        width: 100%;
        margin-top: 1vh;
        border-radius: 10px;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 20px 20px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
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
                icon.textContent = "▼"; // Flecha hacia abajo cuando la tabla está oculta
            } else {
                content.style.display = "block";
                icon.textContent = "▲"; // Flecha hacia arriba cuando la tabla está visible
            }
        });
    }
</script>


