<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A.E. Home</title>
</head>

<body>
    <!-- Header -->
    @include('admin.partials.header')
    <div class="content">
        <div class="sec1">
            <a href="{{ route('admin.ae-home') }}">Registrar Cuenta Consejero</a>
            <a href="{{ route('admin.ae-listado-cuentas') }}">Listado de Cuentas</a>
            <a href="{{ route('admin.votacion.create') }}">Crear votacion</a>
            <a href="javascript:void(0);" onclick="mostrarFormularioVotacion()">Iniciar Votación</a>

            
        </div>
        <hr>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="sec2" action="{{ route('register') }}" method="POST">
            <b>Registro de Usuario</b>
            @csrf
            <input type="number" name="run" placeholder="RUT (Sin punto y/o gui&oacute;n )" maxlength="8">
            <input type="text" name="name" placeholder="Nombre">
            <input type="email" name="email" placeholder="Correo electrónico *" required>
            <input type="text" name="carrera" placeholder="Carrera">
            <input type="number" name="edad" placeholder="Edad">
            <select name="sexo">
                <option value="">Selecciona Sexo</option>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
            <button type="submit">Registrar</button>
        </form>
    </div>

</body>



<hr>

<!-- Formulario de votación, inicialmente oculto -->
<div class="container" id="formularioVotacion" style="display:none;">
    <div class="sec2" style="width: 80%; margin: auto;">
        <h2 class="text-center mb-4" style="font-size: 40px; text-align: center;">Datos de la Votación</h2>
        <form>
            <div class="form-group">
                <label for="tema"><b>Tema de la Votación:</b></label>
                <input type="text" class="form-control" id="tema" placeholder="Ingrese el tema">
            </div>
            <div class="form-group">
                <label for="descripcion"><b>Descripción:</b></label>
                <textarea class="form-control" id="descripcion" rows="3" placeholder="Ingrese la descripción"></textarea>
            </div>
            <div class="form-group">
                <label for="opcion1"><b>Opción 1:</b></label>
                <input type="text" class="form-control" id="opcion1" placeholder="Ingrese la opción 1">
            </div>
            <div class="form-group">
                <label for="opcion2"><b>Opción 2:</b></label>
                <input type="text" class="form-control" id="opcion2" placeholder="Ingrese la opción 2">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Iniciar Votación</button>
            <button type="button" class="btn btn-secondary mt-2">+</button>
        </form>
    </div>
</div>


<script>
    function mostrarFormularioVotacion() {
        var formulario = document.getElementById("formularioVotacion");
        // Mostrar u ocultar el formulario de votación
        if (formulario.style.display === "none") {
            formulario.style.display = "block";
        } else {
            formulario.style.display = "none";
        }
    }
</script>


</html>

<style>
    * {
        padding: 0%;
        margin: 0%;
        font-family: 'Roboto';
    }

    .content {
        height: 90vh;
        width: 100%;
        background-color: #F1F1F1;
        display: flex;
        justify-content: center;
    }

    hr {
        width: 3px;
        margin-top: 1%;
        margin-bottom: 1%;
        height: 98% auto;
        background-color: #000;
        border-radius: 10px;
    }

    .sec2 {
        height: 60%;
        width: 50%;
        margin: 5%;
        padding: 5% 10%;
        border-radius: 10px;
        border-style: solid;
        border-color: #000;
        display: flex;
        justify-content: center;
        flex-direction: column;
    }

    .sec2>b {
        text-align: center;
        font-size: 40px;
        margin-bottom: 10px;
    }

    label>b {
        font-size: 20px;
    }

    input,
    select {
        width: 100%;
        padding: 10px 10px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        font-size: 20px;
    }


    .sec2>button {
        background-color: #FFFFFF;
        color: #000;
        padding: 14px 20px;
        margin: 25px 0;
        border-radius: 10px;
        border-color: #000;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    .sec2>button:hover {
        background-color: #FFBD58;
        color: #FFFFFF;
    }

    .logout>button{
        background-color: #FFFFFF;
        color: #000;
        padding: 14px 20px;
        border-radius: 10px;
        border-color: #000;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    .logout>button:hover {
        background-color: #FFBD58;
        color: #FFFFFF;
    }
</style>
