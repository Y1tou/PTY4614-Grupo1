<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Voto</title>
</head>
<body>
    <p>Estimado usuario,</p>
    <p>Gracias por participar en la votación.</p>
    <p><strong>Detalles del Voto:</strong></p>
    <ul>
        <li><strong>Nombre de la Votación:</strong> {{ $nombreVotacion }}</li>
        <li><strong>Sigla:</strong> {{ $sigla }}</li>
        <li><strong>Opción Elegida:</strong> {{ $opcion_votada }}</li>
    </ul>
    <p>Atentamente,<br>Plataforma de votaciones consejeros DUOC UC</p>
</body>
</html>
