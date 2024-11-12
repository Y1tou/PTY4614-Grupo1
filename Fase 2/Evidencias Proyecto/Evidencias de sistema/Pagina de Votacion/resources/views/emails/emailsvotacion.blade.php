<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Votación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f4f4f9;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #163D64;
        }
        .content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
        }
        .section {
            margin-bottom: 15px;
        }
        .section p {
            font-size: 16px;
            line-height: 1.6;
        }
        .highlight {
            color: #163D64;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <h1>Notificación de Votación</h1>
    <div class="content">
        @if($accion == 'crear')
        <div class="section">
            <p>Se ha creado una nueva votación con la sigla <span class="highlight">{{ $sigla }}</span>.</p>
        </div>
        @elseif($accion == 'eliminar')
        <div class="section">
            <p>La votación con la sigla <span class="highlight">{{ $sigla }}</span> ha sido finalizada.</p>
            <p><strong>Descripción:</strong> {{ $descripcion }}</p>
            <p><strong>Votación ganadora:</strong> {{ $ganador }}</p>
        </div>
        @else
        <div class="section">
            <p>No se ha definido ninguna acción.</p>
        </div>
        @endif
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} - Todos los derechos reservados.</p>
    </div>
</body>
</html>
