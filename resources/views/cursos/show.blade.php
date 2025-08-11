@extends('layouts.plantilla')

@section('title', 'Curso'. $curso->name)

@section('content')
    <h1>Bienvenido al curso: {{$curso->name}}</h1>
    <a href="{{route('cursos.index')}}">Volver a cursos</a>
    <p><strong> Categoria: </strong>{{$curso->categoria}}</p>
    <p>{{$curso->description}}</p>
    <a href="{{route('cursos.cuestionario', $curso->id)}}">Crear Cuestionario</a>
    
    <h2>Cuestionarios del Curso</h2>
    @if ($curso->cuestionarios)
        <h3>Cuestionarios:{{$curso->cuestionarios->titulo}}</h3>
        <ul>
            
            @foreach($curso->cuestionarios->preguntas as $pregunta)
                <li>
                    <strong>{{$pregunta->pregunta}}</strong>
                        
                </li>
            @endforeach

        </ul>

    @else
        <p>No hay cuestionarios disponibles para este curso.</p>

    @endif
    
@endsection
