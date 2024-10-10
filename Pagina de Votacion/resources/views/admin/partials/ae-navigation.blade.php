<!-- resources/views/admin/partials/ae-navigation.blade.php -->

<div class="sec1">
    <a href="{{ route('admin.votacion.create') }}">Crear votación</a>
    <a href="{{ route('admin.ae-votaciones-activas') }}">Votaciones Activas</a>
    <a href="{{ route('admin.ae-historial-votaciones') }}">Historial de Votaciones</a>
    <a href="{{ route('admin.ae-home') }}">Registrar Cuenta Consejero</a>
    <a href="{{ route('admin.ae-listado-cuentas') }}">Listado de Cuentas</a>
</div>

<style>

    .sec1 {
        height: 100% auto;
        width: 20%;
        text-align: center;
        display: flex;
        flex-direction: column;
    }

    .sec1>a {
        margin: 12% 10% 0 10%;
        text-decoration: none;
        font-size: 28px;
        color: #000;
        padding: 0px 12px 0px 12px;
    }

</style>