<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de la Votación</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<header>
    <div class="logo">
        <strong style="color: #F1F1F1;">Duoc</strong>
        <strong style="color: #FFBD58;">UC</strong>
        <p style="color: #F1F1F1;">Consejeros</p>
    </div>
</header>
<body>
    <div class="container">
        <div class="card p-4" style="margin-top: 50px;">
            <h2 class="text-center mb-4">Datos de la Votación</h2>
            <form action="{{ route('votacion.store') }}" method="POST">
                @csrf <!-- Token de seguridad para formularios en Laravel -->
                
                <!-- Campo para el tema de la votación -->
                <div class="form-group">
                    <label for="tema">Tema de la Votación:</label>
                    <input type="text" class="form-control" id="tema" name="tema" placeholder="Ingrese el tema" required>
                </div>
                

                <div class="form-group">
                    <label for="sigla">SIGLA:</label>
                    <input type="text" class="form-control" id="sigla" name="sigla" placeholder="Ingrese la SIGLA" required>
                </div>


                <!-- Campo para la descripción -->
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingrese la descripción" required></textarea>
                </div>
                
                <!-- Campo para la opción 1 -->
                <div class="form-group">
                    <label for="opcion1">Opción 1:</label>
                    <input type="text" class="form-control" id="opcion1" name="opcion1" placeholder="Ingrese la opción 1" required>
                </div>
                
                <!-- Campo para la opción 2 -->
                <div class="form-group">
                    <label for="opcion2">Opción 2:</label>
                    <input type="text" class="form-control" id="opcion2" name="opcion2" placeholder="Ingrese la opción 2" required>
                </div>
                
                <!-- Campo para la opción 3 -->
                <div class="form-group">
                    <label for="opcion3">Opción 3:</label>
                    <input type="text" class="form-control" id="opcion3" name="opcion3" placeholder="Ingrese la opción 3">
                </div>
                
                <!-- Campo para la opción 4 -->
                <div class="form-group">
                    <label for="opcion4">Opción 4:</label>
                    <input type="text" class="form-control" id="opcion4" name="opcion4" placeholder="Ingrese la opción 4">
                </div>

                <!-- Botón para enviar el formulario -->
                <button type="submit" class="btn btn-primary btn-block">Iniciar Votación</button>
                <button type="button" class="btn btn-secondary mt-2">+</button>
            </form>

            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<style>
    * {
        padding: 0;
        margin: 0;
        font-family: 'Roboto', sans-serif;
    }

    header {
        height: 10vh;
        width: 100%;
        background-color: #163D64;
    }

    .logo {
        width: 22%;
        height: 100%;
        display: flex;
        text-align: start;
        margin-left: 1vh;
        align-items: center;
    }

    .logo > strong {
        font-size: 40px;
    }

    .logo > p {
        font-size: 45px;
        font-family: 'Brush Script MT', cursive;
    }

    .container {
        max-width: 600px;
        margin: auto;
        padding: 16px;
    }

    .card {
        border-radius: 10px;
        border: 1px solid #ccc;
        background-color: #EBEBEB;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-control {
        padding: 10px;
        margin-top: 5px;
    }

    .btn {
        background-color: #FFBD58;
        color: white;
    }

    .btn-secondary {
        background-color: #FFBD58;
        color: white;
        width: 100%;
        margin-top: 10px;
    }

    .btn-secondary:hover {
        background-color: #e6a846;
    }

    .btn-block {
        width: 100%;
        padding: 10px;
        margin-top: 20px;
    }
</style>
