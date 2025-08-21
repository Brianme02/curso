@extends('layouts.plantilla')

@section('title', 'Cuestionario del Curso')

@section('content')

    <h1>Cuestionario del Curso {{ $curso->name }}</h1>

    <form id="Cuestionario" action="{{ route('cursos.cuestionario', $curso->id) }}" method="POST">
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

    <script>
        document.getElementById('Cuestionario').addEventListener('submit', function(e) {
            e.preventDefault(); // Evitamos el envío del formulario

            // Conversión del form para enviarlo en la petición
            const formData = new FormData(this);
            submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true; // Deshabilita el botón para evitar múltiples envíos
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
                        window.location.href = "{{ route('cursos.show', $curso) }}";
                    }
                    submitButton.disabled = false; // Habilita el botón nuevamente
                })
                .catch(error => 
                {alert('No se pudo completar la solicitud')
                submitButton.disabled = false; // Habilita el botón nuevamente
                }); //Error genérico
            submitButton.disabled = false; // Habilita el botón nuevamente
        });
    </script>

@endsection
