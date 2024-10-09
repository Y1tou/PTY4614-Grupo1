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
            <form>
                <div class="form-group">
                    <label for="tema">Tema de la Votación:</label>
                    <input type="text" class="form-control" id="tema" placeholder="Ingrese el tema">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea class="form-control" id="descripcion" rows="3" placeholder="Ingrese la descripción"></textarea>
                </div>
                <div class="form-group">
                    <label for="opcion1">Opción 1:</label>
                    <input type="text" class="form-control" id="opcion1" placeholder="Ingrese la opción 1">
                </div>
                <div class="form-group">
                    <label for="opcion2">Opción 2:</label>
                    <input type="text" class="form-control" id="opcion2" placeholder="Ingrese la opción 2">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Iniciar Votación</button>
                <button type="button" class="btn btn-secondary mt-2">+</button>
            </form>
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

    .logo>strong {
        font-size: 40px;
    }

    .logo>p {
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
