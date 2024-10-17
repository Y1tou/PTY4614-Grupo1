@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Votación</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('voto.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="sigla">Sigla</label>
            <select name="sigla" class="form-control" required>
                @foreach($votaciones as $votacion)
                    <option value="{{ $votacion->sigla }}">{{ $votacion->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="opcion_votada">Seleccione una opción</label>
            <select name="opcion_votada" class="form-control" required>
                <option value="opc_1">Opción 1</option>
                <option value="opc_2">Opción 2</option>
                <option value="opc_3">Opción 3</option>
                <option value="opc_4">Opción 4</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Votar</button>
    </form>
</div>
@endsection
