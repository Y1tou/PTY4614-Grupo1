<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Administrador - Listado</title>
</head>

<body>
    <!-- Header -->
    @include('admin.partials.header')
    <div class="content">
        <!--Links -->
        @include('admin.partials.navegation')


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
                <td>{{ $admin->NOMBRE }}</td>
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
                    <form class="btn2" action="{{ route('admin.eliminar-cuenta-admin', $admin->ID) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta cuenta?');">
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

    @if ($errors->any())
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
                <h2 class="text-2xl font-semibold mb-4 text-red-600">Mensaje</h2>
                @foreach ($errors->all() as $error)
                    <p class="mb-4"><li>{{ $error }}</li></p>
                @endforeach
                <button onclick="closeModal()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Cerrar</button>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
                <h2 class="text-2xl font-semibold mb-4 text-green-600">Éxito</h2>
                <p class="mb-4">{{ session('success') }}</p>
                <button onclick="closeModal()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Cerrar</button>
            </div>
        </div>
    @endif


    <!-- Modal para editar administrador -->
    <div id="editModal" style="display:none;">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Editar Administrador</h2>
            <form id="editForm" method="POST" action="{{ route('admin.updateAdmin') }}">
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
    /* * {
        padding: 0%;
        margin: 0%;
        font-family: 'Roboto';
    } */

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

    // Mensaje 
    function closeModal() {
        document.querySelector('.fixed').style.display = 'none';
        }
        
</script>
