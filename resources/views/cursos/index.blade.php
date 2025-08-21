@extends('layouts.plantilla')

@section('title', 'Cursos')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="fw-bold">📚 Lista de Cursos</h1>
            <a href="{{ route('cursos.create') }}" class="btn btn-primary">➕ Crear curso</a>
        </div>
        <ul>
            @foreach ($cursos as $curso)
                <li>
                    <a href="{{ route('cursos.show', $curso->id) }}">{{ $curso->name }}</a>
                </li>
            @endforeach
        </ul>

        <div clas="mt-3">
            {{ $cursos->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
