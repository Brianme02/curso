@extends('layouts.plantilla')

@section('title', 'Modificar Cuestionario')



@section('content')
    <h1>Modificar Cuestionario del Curso {{$curso->name}}</h1> 
    <ul>
            
        @foreach($curso->cuestionarios->preguntas as $pregunta)
            <li>
                <strong>{{$pregunta->pregunta}}</strong>
                <br>
                <a href="{{ route('cursos.modPregunta', ['id' => $curso->id, 'pregunta_id' => $pregunta->id]) }}">Modificar Pregunta</a>
                
                <form action="{{ route('preguntas.destroy', $pregunta->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar esta pregunta?');">Eliminar</button>
                </form>

                
            </li>
        @endforeach
            
    </ul>

@endsection