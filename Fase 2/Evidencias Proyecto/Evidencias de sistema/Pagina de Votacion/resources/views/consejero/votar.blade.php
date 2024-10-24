@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Votaciones Activas</h2>

        @if ($votaciones->isEmpty())
            <p>No hay votaciones activas en este momento.</p>
        @else
            <form action="{{ route('voto.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="sigla">Seleccione una votación:</label>
                    <select name="sigla" id="sigla" class="form-control">
                        @foreach ($votaciones as $votacion)
                            <option value="{{ $votacion->sigla }}">{{ $votacion->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="opcion_votada">Seleccione una opción:</label>
                    <select name="opcion_votada" id="opcion_votada" class="form-control">
                        @foreach ($votaciones as $votacion)
                            <optgroup label="{{ $votacion->nombre }}">
                                <option value="{{ $votacion->opc_1 }}">{{ $votacion->opc_1 }}</option>
                                <option value="{{ $votacion->opc_2 }}">{{ $votacion->opc_2 }}</option>
                                <option value="{{ $votacion->opc_3 }}">{{ $votacion->opc_3 }}</option>
                                <option value="{{ $votacion->opc_4 }}">{{ $votacion->opc_4 }}</option>
                            </optgroup>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Enviar Voto</button>
            </form>
        @endif
    </div>
@endsection
