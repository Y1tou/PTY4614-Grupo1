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


        <div class="overflow-x-auto w-full max-w-6xl mx-auto">
            <table class="sec2">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Nombre</th>
                        <th class="border border-gray-300 px-4 py-2">Correo</th>
                        <th class="border border-gray-300 px-4 py-2">Tipo cuenta</th>
                        <th class="border border-gray-300 px-4 py-2">Modificar</th>
                        <th class="border border-gray-300 px-4 py-2">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $admin->ID }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $admin->NOMBRE }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $admin->CORREO }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $admin->TIPO == \App\Models\Admin::TIPO_SUPERADMIN ? 'Tipo 1' : 'Tipo 2' }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <div class="flex justify-center">
                                <button type="button" class="edit-button bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" 
                                    data-id="{{ $admin->ID }}" 
                                    data-nombre="{{ $admin->NOMBRE }}" 
                                    data-correo="{{ $admin->CORREO }}">
                                    Modificar
                                </button>
                            </div>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <form class="flex justify-center" action="{{ route('admin.eliminar-cuenta-admin', $admin->ID) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta cuenta?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
    <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" style="display:none;">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">Editar Administrador</h2>
                <button class="text-gray-500 hover:text-gray-700 focus:outline-none" onclick="document.getElementById('editModal').style.display='none'">
                    &times;
                </button>
            </div>
            <form id="editForm" method="POST" action="{{ route('admin.updateAdmin') }}">
                @csrf
                <input type="hidden" name="id" id="admin-id">
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="nombre" id="admin-nombre" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="correo" class="block text-sm font-medium text-gray-700">Correo</label>
                    <input type="email" name="correo" id="admin-correo" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none" onclick="document.getElementById('editModal').style.display='none'">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">Actualizar</button>
                </div>
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
        document.getElementById('editModal').style.display = 'flex';
        });
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
