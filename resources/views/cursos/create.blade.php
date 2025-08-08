@extends('layouts.plantilla')

@section('title', 'Cursos Create')

@section('content')
    <h1>En esta pagina podras crear un curso</h1>

    <form action="{{route ('cursos.store')}}" method="POST">
        
        @csrf

        <label>
            Nombre:
            <br>
            <input type="text" name="name">
        </label>
        <label>
            <br>
            Descripcion:
            <br>
            <textarea name="description" rows="5"></textarea>
        </label>

        <label>
            <br>
            Categoria:
            <br>
            <input type="text"  name="categoria">
        </label>
        <br>
        <button type="submit">Enviar formulario</button>
    </form>
@endsection

