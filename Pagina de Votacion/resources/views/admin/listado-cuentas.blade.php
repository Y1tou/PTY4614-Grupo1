<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <a href="">Registrar Cuenta</a>
            <a href="">Listado de Cuentas</a>
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
                <td>{{ $admin->NOMBRE }}</td>
                <td>{{ $admin->CORREO }}</td>
                <td>{{ $admin->TIPO == \App\Models\Admin::TIPO_SUPERADMIN ? 'Tipo 1' : 'Tipo 2' }}</td>
                <td>
                    <form class="btn1" action="{{ route('admin.modificar-cuenta', $admin->ID) }}" method="GET">
                        <button type="submit">
                            Modificar
                        </button>
                    </form>
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

                <!-- <td style="display: flex; justify-content: center;">
                    <img src="C:\Users\angel\Desktop\Nueva carpeta\img\eliminar.png" alt="">
                </td> -->
            </tr>
            @endforeach

        </table>
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
</style>