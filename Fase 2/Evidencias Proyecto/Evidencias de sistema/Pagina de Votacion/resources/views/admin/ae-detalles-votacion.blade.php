<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Header -->
    @include('admin.partials.header')
    <div class="content">
        <strong>Tema de la Votaci&oacute;n: {{$votacion->NOMBRE}}</strong>
        <div class="sec-head">
            <div class="section sec1">
                <div class="sec1-a">
                    <canvas id="graficoBarras" style="width: 100%; max-height: 300px auto;"></canvas>
                </div>
                <div class="sec1-b">
                    <canvas id="graficoPie" style="width: 100%; max-height: 300px;"></canvas>
                </div>
            </div> 
         
            <div class="section sec2">
                <div class="section-a">
                    <strong>Información Adicional</strong>
                    <p>
                        {{$votacion->DESCRIPCION}} 
                    </p>
                    <div class="fechas">
                    @if ($votacion->ESTADO == 0)
                        <p>Fecha de inicio: {{ \Carbon\Carbon::parse($votacion->created_at)->format('d-m-Y') }} </p>
                        <p>Fecha de Termino: {{ \Carbon\Carbon::parse($votacion->updated_at)->format('d-m-Y') }} </p>
                        @else
                            <p>Fecha de inicio: {{ \Carbon\Carbon::parse($votacion->created_at)->format('d-m-Y') }} </p>
                    @endif
                    </div>
                </div>
                <strong>Listado de participantes</strong>
                <div class="tabla-content">
                    <table class="section-b table-secondary">
                        <thead>
                            <tr>
                                <th>Opción 1</th>
                                <th>Opción 2</th>
                                <th>Opción 3</th>
                                <th>Opción 4</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < $maxRows; $i++)
                                <tr>
                                    <td>{{ $nombresOP1[$i] ?? '' }}</td>
                                    <td>{{ $nombresOP2[$i] ?? '' }}</td>
                                    <td>{{ $nombresOP3[$i] ?? '' }}</td>
                                    <td>{{ $nombresOP4[$i] ?? '' }}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <div class="tabla-content">
                    <table class="section-b table-secondary">
                        <thead>
                            <tr>
                                <th>Consejeros Sin Votar</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($sinVotar as $usuario)
                                <tr>
                                    <td class="td-noVoto">
                                        <li>{{ $usuario }}</li>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
        <div class="buttons">
            @if ($votacion->ESTADO == 1)
                <a href="{{ route('admin.ae-votaciones-activas') }}">Volver</a>
                <form action="{{ route('admin.finalizar-votacion', $votacion->SIGLA) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas finalizar la votación?');">
                    @csrf
                    <label for="opc_ganadora" class="text-gray-700">Selecciona la opción ganadora:</label>
                    <select id="opc_ganadora" name="opc_ganadora" required class="border-gray-300 rounded-md">
                        <option value="">Seleccione una opción </option>
                        @if(!empty($votacion->OPC_1))
                            <option value="{{ $votacion->OPC_1 }}">{{ $votacion->OPC_1 }}</option>
                        @endif

                        @if(!empty($votacion->OPC_2))
                            <option value="{{ $votacion->OPC_2 }}">{{ $votacion->OPC_2 }}</option>
                        @endif

                        @if(!empty($votacion->OPC_3))
                            <option value="{{ $votacion->OPC_3 }}">{{ $votacion->OPC_3 }}</option>
                        @endif

                        @if(!empty($votacion->OPC_4))
                            <option value="{{ $votacion->OPC_4 }}">{{ $votacion->OPC_4 }}</option>
                        @endif
                    </select>
                    <button class="finalizar" type="submit">Finalizar</button>
                </form>
            @else
                <a href="{{ route('admin.ae-historial-votaciones') }}">Volver</a>
                <label for="opc_ganadora" class="text-gray-700"><strong>Opcion Ganadora: {{ $votacion->GANADOR }}</strong></label>
            @endif
        </div>
    </div>

    <style>
        .content {
            padding: 20px;
            margin: 20px;
            border: solid #000;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align:center;
        }

        .content>strong{
            font-size: 30px;
        }

        .sec-head{
            display: flex;
            /* justify-content: space-around; */
            /* flex-wrap: wrap; */
            justify-content: space-between; 
        }

        .buttons{
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 12px 20px 2px;
        }

        .buttons>a{
            background-color: #FFBD58;
            color: white;
            padding: 8px 20px;
            border-radius: 10px;
        }

        .buttons>form>button{
            background-color: #FFBD58;
            color: white;
            padding: 8px 20px;
            border-radius: 10px;
        }

        .buttons>a:hover{
            background-color: #cc9634; 
            transform: translateY(0); 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .buttons>form>button:hover{
            background-color: #cc9634; 
            transform: translateY(0); 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .sec2>strong{
            font-size: 22px;
        }

        .section {
            /* width: 48%; */
            width: calc(50% - 20px); 
            margin: 10px;
            padding: 20px;
            background-color: #F1F1F1;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }
        .sec1{
            display: flex;
            justify-content: center;
            height: 400px auto;
        }

        .sec1-a, .sec1-b {
            margin: 10px;
            padding: 20px;
            background-color: #F1F1F1;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }
        .section-a {
            padding: 20px;
            margin: 10px 0;
            border: solid #000;
            border-radius: 10px;
            overflow-x: auto;
        }

         .section-b {
            /* padding: 20px; */
            margin: 10px 0;
            overflow-x: auto;
        }

        .section-a {
            background-color: #9abfd781;
        }

        .section-a>strong{
            font-size: 24px;
        }
        .tabla-content{
            height:250px;
            overflow-x: auto;
            margin-top: 15px;
            border: solid #ddd;
            border-radius: 8px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        
        th {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border-bottom: 2px solid #ddd;
        }

        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .td-noVoto{
            text-align: left;
            padding: ;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .buttons{
            display: flex;
            justify-content: space-between;

        }
        .fechas{
            font-size: 18px;
            padding-right: 5px;
            display: flex;
            justify-content: space-around;
        }

        @media (max-width: 600px) {  
            .content {
                padding: 5px;
                margin: 5px;
                border: none;
                border-radius: none;
                background-color: #ffffff;
                box-shadow: none;
                text-align:center;
            }
            #graficoBarras{
                max-width: 60%;
            }
            #graficoBarras{
                max-width: 80%;
            }

            .section {
                width: 100%; 
            }

            .sec-head {
                flex-direction: column;
            }

            .buttons{
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .buttons > a, .buttons > form > button {
                margin: 10px 0;
            }

            /* Ajustar orde de aparición de .buttons */

            .buttons form {
                order: 1;
            }

            .buttons a {
                order: 2;
            }

            .buttons .finalizar {
                order: 3;
            }

        }

    </style>

    <script>
        const barra = document.getElementById('graficoBarras').getContext('2d');

        const graficoBarras = new Chart(barra, {
            type: 'bar',
            data: {
                labels: [
                    '{{$votacion->OPC_1}} ({{$countOP1}})',
                    '{{$votacion->OPC_2}} ({{$countOP2}})',
                    '{{$votacion->OPC_3}} ({{$countOP3}})',
                    '{{$votacion->OPC_4}} ({{$countOP4}})'
                ],
                datasets: [
                    {
                        label: 'Votos',
                        data: [{{$countOP1}}, {{$countOP2}}, {{$countOP3}}, {{$countOP4}}],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',  // Color para OPC_1
                            'rgba(54, 162, 235, 0.2)',  // Color para OPC_2
                            'rgba(255, 206, 86, 0.2)',  // Color para OPC_3
                            'rgba(75, 192, 192, 0.2)'   // Color para OPC_4
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',    // Color para OPC_1
                            'rgba(54, 162, 235, 1)',    // Color para OPC_2
                            'rgba(255, 206, 86, 1)',    // Color para OPC_3
                            'rgba(75, 192, 192, 1)'     // Color para OPC_4
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true, 
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const pie = document.getElementById('graficoPie').getContext('2d');

        const graficoPie = new Chart(pie, {
            type: 'pie',
            data: {
                labels: [
                    'Personas que no han votado ({{$usuarioSinVotar}})',
                    'Personas que han votado ({{$maxRows}})'
                ],
                datasets: [
                    {
                        label: 'Votos',
                        data: [{{$usuarioSinVotar}}, {{$maxRows}}],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',  // Color para OPC_1
                            'rgba(54, 162, 235, 0.2)',  // Color para OPC_2
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',    // Color para OPC_1
                            'rgba(54, 162, 235, 1)',    // Color para OPC_2
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true, 
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top', // Posición de la leyenda
                    },
                    title: {
                        display: true,
                        text: 'Votos de Consejeros' // Título del gráfico
                    },
                },
            }
        });
    </script>


</body>
</html>
