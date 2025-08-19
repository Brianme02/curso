@extends('layouts.plantilla')

@section('title', 'Modificar Cuestionario')



@section('content')
    <h1>Modificar Cuestionario del Curso {{ $curso->name }}</h1>
    <ul>

        @foreach ($curso->cuestionarios->preguntas as $pregunta)
            <li>
                <strong>{{ $pregunta->pregunta }}</strong>
                <br>
                <a href="{{ route('cursos.modPregunta', ['id' => $curso->id, 'pregunta_id' => $pregunta->id]) }}">Modificar
                    Pregunta</a>

                <form action="{{ route('preguntas.destroy', $pregunta->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('¿Estás seguro de eliminar esta pregunta?');">Eliminar</button>
                </form>


            </li>
        @endforeach

    </ul>
    <script>
        document.getElementById('editarpregunta').addEventListener('submit', function(e) {
            e.preventDefault(); // Evitamos el envío del formulario

            // Conversión del form para enviarlo en la petición
            const formData = new FormData(this);

            const token = formData.get('_token');
            const method = formData.get('_method');
            console.log(formData);

            fetch(this.action, {
                    method: 'POST', //Utiliza el método del form
                    headers: {
                        'X-CSRF-TOKEN': token //Envía el token único de la sesión
                    },
                    body: formData // Pasa los datos del form al request
                })
                .then(response => {
                    const status = response.status; //Obtiene el estado de la respuesta
                    return response.json().then(data => ({
                        status,
                        data
                    }));
                })
                .then(({
                    status,
                    data
                }) => {
                    alert(data.message); // Mostramos mensaje del backend

                    //Redirige si el status fue 2xx (OK)
                    if (status >= 200 && status < 300) {
                        window.location.href = "{{ route('cursos.modCuestionario', $curso) }}";
                    }
                })
                .catch(error => alert('No se pudo completar la solicitud')); //Error genérico

        });
    </script>
@endsection
