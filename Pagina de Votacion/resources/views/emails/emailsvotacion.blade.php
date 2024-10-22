
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Notificación de Votación</title>
</head>
<body>
    <h1>Notificación de Votación</h1>
    <p>Acción: {{ $accion }}</p> <!-- Agregar esta línea para depuración -->
    @if($accion == 'crear')
        <p>Se ha creado una nueva votación con la sigla <strong>{{ $sigla }}</strong>.</p>
    @elseif($accion == 'eliminar')
        <p>Se ha eliminado la votación con la sigla <strong>{{ $sigla }}</strong>.</p>
    @else
        <p>No se ha definido ninguna acción.</p>
    @endif
</body>
</html>
