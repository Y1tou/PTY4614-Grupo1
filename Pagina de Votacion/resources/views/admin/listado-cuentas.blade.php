<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Listado</title>
</head>

<body>
<header>
        <div class="logo">
            <strong style="color: #F1F1F1;">Duoc</strong>
            <strong style="color: #FFBD58;">UC</strong>
            <p style="color: #F1F1F1;">Consejeros</p>
        </div>

        <form class="logout" action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </header>

    <div class="content">
        <div class="sec1">
            <a href="{{ route('admin.registrar-cuenta') }}">Registrar Cuenta</a>
            <a href="{{ route('admin.listado-cuentas') }}">Listado de Cuentas</a>
        </div>

        <hr>
        <table class="sec2">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Tipo cuenta</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
            @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->ID }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->CORREO }}</td>
                <td>{{ $admin->TIPO == \App\Models\Admin::TIPO_SUPERADMIN ? 'Tipo 1' : 'Tipo 2' }}</td>
                <td>
                    <div class="btn1"  method="GET">
                        <button type="button" class="edit-button" data-id="{{ $admin->ID }}" data-nombre="{{ $admin->NOMBRE }}" data-correo="{{ $admin->CORREO }}">
                            Modificar
                        </button>

                    </div>
                </td>
                <td>
                    <form class="btn2" action="{{ route('admin.eliminar-cuenta', $admin->ID) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta cuenta?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach

        </table>
    </div>


    <!-- Modal para editar administrador -->
    <div id="editModal" style="display:none;">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Editar Administrador</h2>
            <form id="editForm" method="POST" action="{{ route('admin.update') }}">
                @csrf
                <input type="hidden" name="id" id="admin-id">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="admin-nombre">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="admin-correo" required>
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

    header {
        height: 10vh;
        width: 100%;
        background-color: #163D64;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logout{
        margin-right: 30px;
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
        text-decoration: none;
        font-family: 'Roboto';
    }

    .logo>p {
        font-size: 45px;
        font-family: 'Brush Script MT', cursive;
        text-decoration: none;
    }

    .content {
        height: 90vh;
        width: 100%;
        background-color: #F1F1F1;
        display: flex;
        justify-content: center;
    }

    .sec1 {
        height: 100% auto;
        width: 20%;
        text-align: center;
        display: flex;
        flex-direction: column;
    }

    .sec1>a {
        margin: 8% 20% 0 20%;
        text-decoration: none;
        font-size: 30px;
        color: #000;
        padding: 0px 12px 0px 12px;

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
        width: 90%;
        margin: 5%;
        border-radius: 10px;
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
        height:20%;
        margin: auto;
        margin-top: 10%;
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
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

</style>

<script>
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function() {
            // Rellenar el formulario con los datos del administrador
            document.getElementById('admin-id').value = this.getAttribute('data-id');
            document.getElementById('admin-nombre').value = this.getAttribute('data-nombre');
            document.getElementById('admin-correo').value = this.getAttribute('data-correo');
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
