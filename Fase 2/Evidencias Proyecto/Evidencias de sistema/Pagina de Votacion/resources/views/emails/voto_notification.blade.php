<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Voto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f4f4f9;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
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
            color: #4CAF50;
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
    <h1>Notificación de Voto</h1>
    <div class="content">
        <p>Estimado consejero,</p>
        <p>Gracias por participar en la votación.</p>
        <p><strong>Detalles del Voto:</strong></p>
        <ul>
            <li><strong>Nombre de la Votación:</strong> <span class="highlight">{{ $nombreVotacion }}</span></li>
            <li><strong>Sigla:</strong> <span class="highlight">{{ $sigla }}</span></li>
            <li><strong>Opción Elegida:</strong> <span class="highlight">{{ $opcion_votada }}</span></li>
        </ul>
    </div>
    <div class="footer">
        <p>Atentamente,<br>Plataforma de votaciones consejeros Duoc UC</p>
    </div>
</body>
</html>
