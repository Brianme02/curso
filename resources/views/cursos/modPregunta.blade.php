@extends('layouts.plantilla')
@section('title', 'Modificar Pregunta')

@section('content')

    <h1>Modificar Pregunta del Cuestionario del Curso {{$curso->name}}</h1>

    <form action="{{ route('preguntas.update', $pregunta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="texto" value="{{ $pregunta->pregunta }}" required>

        <button type="submit">Actualizar</button>
    </form>

    <a href="{{ route('cursos.index', $curso->id) }}">Volver a Cursos</a>

@endsection

