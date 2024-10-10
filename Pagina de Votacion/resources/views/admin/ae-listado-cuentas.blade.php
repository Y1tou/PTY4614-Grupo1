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
        <!-- Links -->
        @include('admin.partials.ae-navigation')
        <hr>

        <table>
            <tr>
                <th>RUN</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Carrera</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->run }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->carrera }}</td>
                <td>{{ $user->edad }}</td>
                <td>{{ $user->sexo }}</td>
                <td>
                    <div class="btn1"  method="GET">
                        <button type="button" class="edit-button" data-id="{{ $user->id }}" data-run="{{ $user->run }}" data-nombre="{{ $user->name }}" data-correo="{{ $user->email }}" data-carrera="{{ $user->carrera }}" data-edad="{{ $user->edad }}" data-sexo="{{ $user->sexo }}">
                        Modificar
                        </button>
                    </div>
                </td>
                <td>
                    <form class="btn2" action="{{ route('admin.eliminar-cuenta', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta cuenta?');">
                    @csrf
                        @method('DELETE')
                        <button type="submit">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </table>
    </div>

    <!-- Modal para editar administrador -->
    <div id="editModal" style="display:none;">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Editar Usuario</h2>
            <form id="editForm" method="POST" action="{{ route('admin.update') }}">
                @csrf
                <input type="hidden" name="id" id="user-id">
                <label for="run">RUN:</label>
                <input type="number" name="run" id="user-run">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="user-nombre">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="user-correo" required>
                <label for="carrera">Carrera:</label>
                <input type="text" name="carrera" id="user-carrera">
                <label for="edad">Edad:</label>
                <input type="number" name="edad" id="user-edad">
                <label for="sexo">Sexo:</label>
                <select name="sexo" id="user-sexo">
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
                <button type="submit">Actualizar</button>
            </form>
        </div>
    </div>
</body>

</html>

<style>
  * {
        padding: 0%;
        margin: 0%;
        font-family: 'Roboto';
    }

    .btn1,.btn2{
        display:flex;
        justify-content:center;
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

    
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        height: 10%;
        width: 70%;
        margin: 5%;
        border-radius: 20px;
        border-style: solid;
        border-color: #000;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 20px 20px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    img {
        width: 25px;
        height: 25px;
    }

    
    /* Estilo del modal */
    .modal-content {
        background-color: white;
        padding: 20px;
        border: 1px solid #ccc;
        width: 40%;
        margin: auto;
        margin-top: 2%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    #editModal {
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }

    .close-button {
        cursor: pointer;
    }


    #editForm {
        display: flex;
        flex-direction: column;
        width: 100%; /* Asegura que el formulario ocupe todo el ancho disponible */
    }

    #editForm label {
        margin-top: 10px;
        font-size: 18px;
        font-weight: bold;
    }

    #editForm input {
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 15px;
        width: 100%; /* Asegura que los inputs ocupen todo el ancho disponible */
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    #editForm button {
        padding: 10px;
        background-color: #FFBD58;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
        margin-top: 10px;
    }

    #editForm button:hover {
        background-color: #ff9d3f;
    }

    #editForm select {
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    width: 100%; /* Asegura que el select ocupe todo el ancho disponible */
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid #ccc;
}


</style>

<script>
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function() {
            // Rellenar el formulario con los datos del usuario
            document.getElementById('user-id').value = this.getAttribute('data-id');
            document.getElementById('user-run').value = this.getAttribute('data-run');
            document.getElementById('user-nombre').value = this.getAttribute('data-nombre');
            document.getElementById('user-correo').value = this.getAttribute('data-correo');
            document.getElementById('user-carrera').value = this.getAttribute('data-carrera');
            document.getElementById('user-edad').value = this.getAttribute('data-edad');
            document.getElementById('user-sexo').value = this.getAttribute('data-sexo');
            // Mostrar el modal
            document.getElementById('editModal').style.display = 'block';
        });
    });

    document.querySelector('.close-button').addEventListener('click', function() {
        document.getElementById('editModal').style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === document.getElementById('editModal')) {
            document.getElementById('editModal').style.display = 'none';
        }
    });
</script>