@extends('layouts.plantilla')

@section('title', 'Cuestionario del Curso')

@section('content')

    <h1>Cuestionario del Curso {{$curso->name}}</h1>

    <form action="{{ route('cursos.cuestionario', $curso->id) }}" method="POST">
        @csrf
         

        <label>
            Título del Cuestionario:
            <br>
            <input type="text" name="titulo" required>
        </label>
        <br>

        <label>
            Pregunta:
            <br>
            <textarea type="text" name="pregunta" rows="5" required></textarea>
        </label>
        <br>
        <button type="submit">Crear Cuestionario</button>
    </form>

    <a href="{{ route('cursos.index', $curso->id) }}">Volver a Cursos</a>

@endsection