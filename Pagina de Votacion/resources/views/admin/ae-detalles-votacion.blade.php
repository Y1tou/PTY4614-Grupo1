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
                <canvas id="miGrafico" style="width: 100%; height: auto;"></canvas>
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
                            <p>Fecha de Termino: {{ \Carbon\Carbon::parse($votacion->updated_at)->format('d-m-Y') }} </p>
                    @endif
                    </div>
                </div>
                <strong>Listado de participantes</strong>
                <table class="section-b">
                    <tr>
                        <th>Opción 1</th>
                        <th>Opción 2</th>
                        <th>Opción 3</th>
                        <th>Opción 4</th>
                    </tr>
                    <tr>
                        <td>Datos 1</td>
                        <td>Datos 2</td>
                        <td>Datos 3</td>
                        <td>Datos 4</td>
                    </tr>

                    <tr>
                        <td>Datos 1</td>
                        <td>Datos 2</td>
                        <td>Datos 3</td>
                        <td>Datos 4</td>
                    </tr>
                    <tr>
                        <td>Datos 1</td>
                        <td>Datos 2</td>
                        <td>Datos 3</td>
                        <td>Datos 4</td>
                    </tr>
                    <tr>
                        <td>Datos 1</td>
                        <td>Datos 2</td>
                        <td>Datos 3</td>
                        <td>Datos 4</td>
                    </tr>
                </table>
            </div>  
        </div>
        <div class="buttons">
            @if ($votacion->ESTADO == 1)
                <a href="{{ route('admin.ae-votaciones-activas') }}">Volver</a>
                <form action="{{ route('admin.finalizar-votacion', $votacion->SIGLA) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas finalizar la votación?');">
                    @csrf
                    <button class="finalizar" type="submit">Finalizar</button>
                </form>
            @else
                <a href="{{ route('admin.ae-historial-votaciones') }}">Volver</a>
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

        .section-a, .section-b {
            padding: 20px;
            margin: 10px 0;
            border: solid #000;
            border-radius: 10px;
            background-color: #9abfd781;
            overflow-x: auto;
        }

        .section-a>strong{
            font-size: 24px;
        }

        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-top: 1vh;
            border-radius: 10px;
        }
        
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #4CAF50;
            color: white;
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

        @media (max-width: 768px) {
            .section {
                width: 100%; 
            }

            .sec-head {
                flex-direction: column;
            }

            .buttons > a, .buttons > form > button {
                margin: 10px 0;
            }
    }

    </style>

<script>
    const ctx = document.getElementById('miGrafico').getContext('2d');
        
    const miGrafico = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['{{$votacion->OPC_1}}','{{$votacion->OPC_2}}','{{$votacion->OPC_3}}','{{$votacion->OPC_4}}'],
            datasets: [
                {
                    label: 'Opcion 1',
                    data: [12, 0, 0, 0],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Opcion 2',
                    data: [0, 19, 0, 0],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Opcion 3',
                    data: [0, 0, 3, 0],
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Opcion 4',
                    data: [0, 0, 0, 5],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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
    </script>
</body>
</html>
