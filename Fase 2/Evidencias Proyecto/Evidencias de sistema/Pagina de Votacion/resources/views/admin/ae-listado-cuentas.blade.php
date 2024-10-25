<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A.E. Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- Header -->
    @include('admin.partials.header')
    <div class="content">
        <!-- Links -->
        @include('admin.partials.ae-navigation')

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>RUT</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Carrera</th>
                        <th>Edad</th>
                        <th>Sexo</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td data-rut>{{ $user->run }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->carrera }}</td>
                        <td>{{ $user->edad }}</td>
                        <td>{{ $user->sexo }}</td>
                        <td>
                            <button type="button" class="edit-button" data-id="{{ $user->id }}" data-run="{{ $user->run }}" data-nombre="{{ $user->name }}" data-correo="{{ $user->email }}" data-carrera="{{ $user->carrera }}" data-edad="{{ $user->edad }}" data-sexo="{{ $user->sexo }}">
                                <i class="fas fa-edit"></i> Modificar
                            </button>
                        </td>
                        <td>
                            <form action="{{ route('admin.eliminar-cuenta', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta cuenta?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

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
            
            @if(session('success'))
                <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
                        <h2 class="text-2xl font-semibold mb-4 text-green-600">¡Éxito!</h2>
                        <p class="mb-4">{{ session('success') }}</p>
                        <button onclick="closeModal()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Cerrar</button>
                    </div>
                </div>
            @endif
        </div>
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
                <input type="number" name="run" id="user-run" minlength="7" maxlength="8" required>
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

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .table-container {
            margin: 20px auto;
            width: 90%;
            max-width: 1200px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .edit-button,
        .delete-button {
            background-color: #FFBD58;
            border: none;
            border-radius: 5px;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
        }

        .edit-button:hover {
            background-color: #ff9d3f;
        }

        .delete-button {
            background-color: #e57373;
        }

        .delete-button:hover {
            background-color: #ef5350;
        }

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
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #editModal {
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            margin-top: 10vh;
            padding-bottom: 20vh ;
        }

        .close-button {
            cursor: pointer;
        }

        #editForm {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        #editForm label {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        #editForm input,
        #editForm select {
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            width: 100%;
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
    </style>

    <script>
        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('user-id').value = this.getAttribute('data-id');
                document.getElementById('user-run').value = this.getAttribute('data-run');
                document.getElementById('user-nombre').value = this.getAttribute('data-nombre');
                document.getElementById('user-correo').value = this.getAttribute('data-correo');
                document.getElementById('user-carrera').value = this.getAttribute('data-carrera');
                document.getElementById('user-edad').value = this.getAttribute('data-edad');
                document.getElementById('user-sexo').value = this.getAttribute('data-sexo');
                document.getElementById('editModal').style.display = 'block';
            });
        });

        document.querySelector('.close-button').addEventListener('click', function () {
            document.getElementById('editModal').style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            if (event.target === document.getElementById('editModal')) {
                document.getElementById('editModal').style.display = 'none';
            }
        });
        
        function calcularDV(rut) {
            let suma = 0;
            let multiplicador = 2;

            // Asegúrate de que el RUT es una cadena de números
            rut = rut.toString().replace(/\./g, '').replace(/-/g, ''); // Elimina puntos y guiones

            for (let i = rut.length - 1; i >= 0; i--) {
                suma += parseInt(rut.charAt(i)) * multiplicador;
                multiplicador = multiplicador === 7 ? 2 : multiplicador + 1; // Cambia entre 2 y 7
            }

            const resto = suma % 11;
            const dv = 11 - resto;

            if (dv === 11) return '0'; // Si el resultado es 11, el DV es 0
            if (dv === 10) return 'K'; // Si el resultado es 10, el DV es K
            return dv.toString(); // Retorna el dígito verificador
        }

        // Función para formatear el RUN en el formato deseado: XX.XXX.XXX-DV
            function formatRun(rut) {
                // Asegurarse de que el rut no tenga puntos ni guiones antes de formatear
                rut = rut.replace(/\./g, '').replace('-', '');
                
                // Calcular el DV si no está presente
                let dv = '';
                if (rut.length === 8) {
                    dv = calcularDV(rut);
                } else if (rut.length === 7) {
                    dv = calcularDV(rut);
                } else if (rut.length === 9) {
                    dv = rut.slice(-1); // Suponiendo que el último dígito es el DV
                    rut = rut.slice(0, -1); // Quitar el DV para formatear el número base
                }

               // Manejar RUTs de 7 dígitos
                if (rut.length === 7) {
                    const formattedRut = `${rut.slice(0, 1)}.${rut.slice(1, 4)}.${rut.slice(4, 7)}-${dv}`;
                    return formattedRut;
                }

                // Manejar RUTs de 8 dígitos
                if (rut.length === 8) {
                    const formattedRut = `${rut.slice(0, 2)}.${rut.slice(2, 5)}.${rut.slice(5, 8)}-${dv}`;
                    return formattedRut;
                }
            }

            // Aplicar el formato a todos los RUNs cuando la página se carga
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('td[data-rut]').forEach(td => {
                    const rut = td.textContent;
                    td.textContent = formatRun(rut);
                });
            });

        // Mensaje 
        function closeModal() {
        document.querySelector('.fixed').style.display = 'none';
        }
    </script>
</body>

</html>
