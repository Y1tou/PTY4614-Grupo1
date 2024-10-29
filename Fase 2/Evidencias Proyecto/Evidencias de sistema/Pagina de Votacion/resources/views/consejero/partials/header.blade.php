<header>
        <div class="logo">
            <strong style="color: #F1F1F1;">Duoc</strong>
            <strong style="color: #FFBD58;">UC</strong>
            <p style="color: #F1F1F1;">Consejeros</p>
        </div>
        <form class="logout btn-log" action="{{ route('logout') }}" method="POST">
            <div><p>{{ Auth::user()->name }}</p></div>
            @csrf
            <button class="btn-log" type="submit">Cerrar sesión</button>
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
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logout>div{
        margin-right: 50px;
        color:white;
    }

    .logout>button{
        background-color: #FFFFFF;
        color: #000;
        padding: 14px 20px;
        border-radius: 10px;
        border-color: #000;
        cursor: pointer;
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

    @media (max-width: 1100px) {  

        body{
            padding-top: 17vh;
        }  

        .btn-log{
            display: none;
        }

        .logo>strong {
            font-size: 35px;
            text-decoration: none;
            font-family: 'Roboto';
        }

        .logo>p {
            font-size: 40px;
            font-family: 'Brush Script MT', cursive;
            text-decoration: none;
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
    
    @media (max-width: 400px){

        header {
            height: 8vh;
        }

        body{
            padding-top: 16vh;
        }  

        .logo>strong {
            font-size: 30px;
            text-decoration: none;
            font-family: 'Roboto';
        }

        .logo>p {
            font-size: 35px;
            font-family: 'Brush Script MT', cursive;
            text-decoration: none;
        }
    }
</style>


