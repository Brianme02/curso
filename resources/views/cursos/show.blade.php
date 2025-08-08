@extends('layouts.plantilla')

@section('title', 'Curso'. $curso->name)

@section('content')
    <h1>Bienvenido al curso: {{$curso->name}}</h1>
    <a href="{{route('cursos.index')}}">Volver a cursos</a>
    <p><strong> Categoria: </strong>{{$curso->categoria}}</p>
    <p>{{$curso->description}}</p>
@endsection
