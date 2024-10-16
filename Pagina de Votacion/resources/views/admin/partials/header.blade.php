<!-- resources/views/admin/partials/header.blade.php -->
<!-- @vite(['resources/css/app.css']) -->
@vite(['resources/css/app.css'])

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

<style>
    
    header {
        position: fixed; /* Fija el header en la parte superior */
        top: 0; /* Ubicación en la parte superior */
        left: 0; /* Se asegura de que cubra todo el ancho */
        width: 100%;
        height: 10vh;
        background-color: #163D64;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 1000; /* Asegura que esté sobre otros elementos */
        padding: 0 20px; /* Espaciado interno para que no se corte el contenido */
    }

    body {
        padding-top: 10vh; /* Asegura que el contenido no quede oculto bajo el header */
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

    * {
        padding: 0;
        margin: 0;
        font-family: 'Roboto', sans-serif;
    }

    @media (max-width: 768px) {

        body{
            padding-top: 18vh;
        }    

        .logout{
        margin-right: 0px;
        }

        .logout>button{
            background-color: #FFFFFF;
            color: #000;
            padding: 10px 16px;
            border-radius: 10px;
            width: 100%;
            font-size: 12px;
        }
    }
</style>


