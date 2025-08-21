@extends('layouts.plantilla')

@section('title', 'Curso' . $curso->name)

@section('content')
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h1>Bienvenido al curso: {{ $curso->name }}</h1>
        </div>
        <div class="card-body">
            <p><strong> Categoria: </strong>{{ $curso->categoria }}</p>
            <p>{{ $curso->description }}</p>
            <a href="{{ route('cursos.index') }}" class="btn btn-primary">Volver a cursos</a>
            <a href="{{ route('cursos.cuestionario', $curso->id) }}" class="btn btn-primary">Crear Cuestionario</a>

            <h2>Cuestionarios del Curso</h2>
            @if ($curso->cuestionarios)
                <h3>Cuestionarios:{{ $curso->cuestionarios->titulo }}</h3>
                <ul>

                    @foreach ($curso->cuestionarios->preguntas as $pregunta)
                        <li>
                            <strong>{{ $pregunta->pregunta }}</strong>

                        </li>
                    @endforeach

                </ul>
                <a href="{{ route('cursos.modCuestionario', $curso->id) }}" class="btn btn-primary">Modificar Cuestionario</a>
            @else
                <p>No hay cuestionarios disponibles para este curso.</p>

            @endif
        </div>
    </div>
@endsection
