@extends('layouts.plantilla')

@section('title', 'Cursos Create')

@section('content')
    <h1>En esta pagina podras crear un curso</h1>

    <form id="curso" action="{{ route('cursos.store') }}" method="POST">

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
            <input type="text" name="categoria">
        </label>
        <br>
        <button type="submit">Enviar formulario</button>
    </form>
    <script>
        document.getElementById('curso').addEventListener('submit', function(e) {
            e.preventDefault(); // Evitamos el envío del formulario

            // Conversión del form para enviarlo en la petición
            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
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
                        window.location.href = "{{ route('cursos.index') }}";

                    }
                    submitButton.disabled = false; // Habilita el botón nuevamente

                })
                .catch(error => 
                {alert('No se pudo completar la solicitud')
                submitButton.disabled = false; // Habilita el botón nuevamente
                }); //Error genérico
            
        });
    </script>

@endsection
