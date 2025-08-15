<?php
use Illuminate\Http\Request;
use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Curso;

Route::get('/',  HomeController::class);


/*Route::controller(CursoController::class)->group(function(){

    Route::get('/cursos', 'index')->name('cursos.index');
    Route::get('cursos/create','create')->name('cursos.create');
    Route::get('cursos/{id}', 'show')->name('cursos.show');
    Route::post('cursos','store')->name('cursos.store');
});*/

Route::get('/cursos', [CursoController::class,'index'])->name('cursos.index');
Route::get('cursos/create',[CursoController::class,'create'])->name('cursos.create');
Route::get('cursos/{id}', [CursoController::class,'show'])->name('cursos.show');
Route::post('cursos',[CursoController::class,'store'])->name('cursos.store');
Route::get('curso/{id}/cuestionario', [CursoController::class,'cuestionario'])->name('cursos.cuestionario');
Route::post('curso/{id}/cuestionario', [CursoController::class,'guardarCuestionario'])->name('cursos.guardarCuestionario');
Route::get('cursos/{id}/ModificarCuestionario',[CursoController::class,'modCuestionario'])->name('cursos.modCuestionario');
Route::get('cursos/{id}/ModificarPregunta',[CursoController::class,'modPregunta'])->name('cursos.modPregunta');
Route::put('curso/{id}/ModificarPregunta', [CursoController::class, 'update'])->name('preguntas.update');
Route::delete('curso/{id}/ModificarCuestionario', [CursoController::class, 'destroy'])->name('preguntas.destroy');



/*Route::get('/json-prueba', function (Request $request) {
    return response()->json([
            'status' => 200, // Código de estado de la petición
            'message' => 'Artículo obtenido con éxito', // Mensaje para mostrar al usuario
            'data' => [
            'id' => 1,
            'titulo' => 'Introducción a Laravel',
            'contenido' => 'Este es un artículo de ejemplo sobre Laravel.',
            'autor' => 'Juan Pérez',
            'fecha_creacion' => '2025-08-13']
    ]);
});*/

/*Route::get('cursos/{cursos}/{categoria?}', function ($cursos, $categoria=null) {
    
    if ($categoria) {
        return "Bienvenido al curso: $cursos de la categoria: $categoria";
    } else {
        return "Bienvenido al curso: $cursos";
    }
    
});*/

