<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Votaciones</title>
</head>

<body>
    <!-- Header -->
    @include('admin.partials.header')
    <div class="content">
        <!-- Links -->
        @include('admin.partials.ae-navigation')

        <div class="sec2">
            <b>Historial de Votaciones</b>
            <div class="card">
                <b>Tema de la votación: Texto Ejemplo</b>
                <div class="display_">
                    <button type="button" class="collapsible"> <b>+</b> </button>
                    <div class="content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <b>Fecha de inicio: 00/00/00 </b>
                <button class="a"> - </button>


                </div>
            </div>
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

    .card{
        margin: 5%;
        padding: 0 5% 0 5%;
        border-radius: 10px;
        border-style: solid;
        border-color: #000;
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .card>button{
        margin: 5%;
        padding: 0 5px 0 5px;
    }

    .a{background-color:green;}

    /* Display */

    .collapsible {
        background-color: #777;
        color: white;
        cursor: pointer;
        /* padding: 18px; */
        /* width: 100%; */
        border: none;
        /* text-align: left; */
        outline: none;
        /* font-size: 15px; */
        }

    .active, .collapsible:hover {
        background-color: #555;
        }

    .display_>.content {
        /* padding: 0 18px; */
        display: none;
        overflow: hidden;
        background-color: #f1f1f1;
        height:10px;
        }

</style>





<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>

