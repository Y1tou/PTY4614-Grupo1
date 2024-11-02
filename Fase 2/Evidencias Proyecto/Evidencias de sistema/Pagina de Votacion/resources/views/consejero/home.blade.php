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
            @foreach ($votacion as $voto)
            @if ($voto->ESTADO == 1)
                <div class="space-y-6">
                    <form class="bg-white shadow-md rounded p-4 border" action="{{ route('voto.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sigla" value="{{ $voto->SIGLA }}">
        
                        <div class="flex justify-between items-center">
                            <div class="font-bold text-xl">Tema de la Votación: {{ $voto->NOMBRE }}</div>
                            <div class="text-gray-600">Fecha Inicio: {{ \Carbon\Carbon::parse($voto->created_at)->format('d-m-Y') }}</div>
                        </div>
        
                        <p class="text-gray-700 my-4">
                            Descripción: {{ $voto->DESCRIPCION }}
                        </p>
        
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
                    </form>
                </div>
            @endif
        @endforeach
        </main>
    </div>
</body>

</html>
