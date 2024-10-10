<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votaciones Activas</title>
</head>

<body>
    <!-- Header -->
    @include('admin.partials.header')
    <div class="content">
        <!-- Links -->
        @include('admin.partials.ae-navigation')
        <hr>

        <div class="sec2">
            <b>Votaciones Activas</b>
            
        </div>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    </div>


</body>

</html>

<style>
  * {
        padding: 0%;
        margin: 0%;
        font-family: 'Roboto';
    }

    .content {
        height: 90vh;
        width: 100%;
        background-color: #F1F1F1;
        display: flex;
        justify-content: center;
    }

    hr {
        width: 3px;
        margin-top: 1%;
        margin-bottom: 1%;
        height: 98% auto;
        background-color: #000;
        border-radius: 10px;
    }

    .sec2 {
        height: 60%;
        width: 50%;
        margin: 5%;
        padding: 5% 10%;
        border-radius: 10px;
        border-style: solid;
        border-color: #000;
        display: flex;
        justify-content: center;
        flex-direction: column;
    }

    .sec2>b {
        text-align: center;
        font-size: 40px;
        margin-bottom: 10px;
    }

</style>
