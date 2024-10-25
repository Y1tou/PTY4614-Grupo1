<div class="navbar">
    <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
</div>

<div class="sec1" id="nav-menu">
    <a href="{{ route('admin.ae-home') }}" class="{{ request()->routeIs('admin.ae-home') ? 'active' : '' }}">Registrar Cuenta Consejero</a>
    <a href="{{ route('admin.ae-listado-cuentas') }}" class="{{ request()->routeIs('admin.ae-listado-cuentas') ? 'active' : '' }}">Listado de Cuentas</a>
    <a href="{{ route('admin.votacion.create') }}" class="{{ request()->routeIs('admin.votacion.create') ? 'active' : '' }}">Crear votación</a>
    <a href="{{ route('admin.ae-votaciones-activas') }}" class="{{ request()->routeIs('admin.ae-votaciones-activas') ? 'active' : '' }}">Votaciones Activas</a>
    <a href="{{ route('admin.ae-historial-votaciones') }}" class="{{ request()->routeIs('admin.ae-historial-votaciones') ? 'active' : '' }}">Historial de Votaciones</a>
    <form class="logout log-btn" action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
        @csrf
        <button class="log-btn" type="submit">Cerrar sesión</button>
    </form>
</div>

<div class="hr"></div>

<style>
    /* Estilos de la barra de navegación */
    .navbar {
        display: none; /* Ocultar por defecto */
    }

    .menu-icon {
        font-size: 30px;
        cursor: pointer;
        display: none; /* Ocultar por defecto */
    }

    .a{
        display: none;
    }

    .sec1 {
        position: fixed; 
        top: 10vh; 
        left: 0;
        height: 90vh;
        width: 40vh;
        text-align: center;
        display: flex;
        flex-direction: column;
        background-color: #f0f0f0;
        padding-top: 20px;
        z-index: 999; 
        overflow-y: auto; /* Permitir desplazamiento vertical */
    }

    .sec1 > a {
        display: block;
        width: 80%;
        margin: 12px auto;
        text-decoration: none;
        font-size: 22px;
        color: #000;
        padding: 10px 0;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    .sec1 > a:hover {
        background-color: #163D64;
        color: #fff; 
        border-radius: 5px;
    }

    .sec1 > a.active {
        background-color: #FFBD58;
        color: #fff;
        font-weight: bold;
    }

    .hr {
        position: fixed;
        top: 12vh; 
        left: 40vh;
        width: 3px;
        height: 86vh;
        background-color: #000;
        border-radius: 10px;
        z-index: 998; 
    }

    body {
        padding-left: 40vh;
        /* background-color:#f0f0f0; */
    }

    .log-btn{
        display: none;
    }

    /* Estilos para pantallas pequeñas */
    @media (max-width: 1100px) {
        .navbar{
            /* display:black; */
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 20px;
            background-color: #f0f0f0;
            position: fixed;
            width: 100%;
            z-index: 1000;
            top: 10vh;
            border-bottom:solid #000;
        }

        .sec1 {
            display: none; /* Ocultar el menú por defecto */
            top: 17vh; 
            width:30vh;
            height:100%;
            border-right:solid #000;
            border-bottom:solid #000;
        }

        .sec1 > a {
        margin: 10px auto;
        font-size: 20px;
        padding: 8px 0;
        border-radius: 5px;
        }

        .menu-icon {
            display: block; /* Mostrar el ícono del menú en pantallas pequeñas */
        }

        body {
            padding-left: 0; /* No aplicar padding en pantallas pequeñas */
        }

        .hr{
            display: none; /* Ocultar el menú por defecto */
        }

        .log-btn{
            display: flex;
            margin: 10px auto;
            font-size: 20px;
            padding: 8px 0;
            border-radius: 5px;
        }
    }

    @media (max-width: 400px) {

        .sec1 {
            top: 12vh; 
        }

        .navbar{
            top: 8vh;
            padding: 0 15px;
        }

        .log-btn{
            display: flex;
            margin: 10px auto;
            font-size: 20px;
            padding: 8px 0;
            border-radius: 5px;
        }
    }

    .sec1.show {
        display: flex; /* Mostrar el menú cuando se activa */
    }
</style>

<script>
    function toggleMenu() {
        var menu = document.getElementById("nav-menu");
        menu.classList.toggle("show");
    }
</script>
