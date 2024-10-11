<!-- resources/views/admin/partials/header.blade.php -->
<!-- @vite(['resources/css/header.css']) -->

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
<!-- 
<style>
    
    header {
        height: 10vh;
        width: 100%;
        background-color: #163D64;
        display: flex;
        justify-content: space-between;
        align-items: center;
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


</style> -->