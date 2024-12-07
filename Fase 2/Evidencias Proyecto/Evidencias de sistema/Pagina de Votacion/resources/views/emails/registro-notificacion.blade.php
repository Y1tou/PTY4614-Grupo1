<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
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
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <h1>Bienvenido a nuestra plataforma</h1>
    <div class="content">
        <p>Hola <strong>{{ $user->name }}</strong>,</p>
        <p>Tu cuenta ha sido registrada exitosamente con el correo <strong>{{ $user->email }}</strong>.</p>
        <p>Ahora puedes acceder a la plataforma y disfrutar de nuestros servicios.</p>
        <p>Si tienes alguna duda, no dudes en contactarnos.</p>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} - Todos los derechos reservados.</p>
    </div>
</body>
</html>
