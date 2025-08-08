<?php
use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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


/*Route::get('cursos/{cursos}/{categoria?}', function ($cursos, $categoria=null) {
    
    if ($categoria) {
        return "Bienvenido al curso: $cursos de la categoria: $categoria";
    } else {
        return "Bienvenido al curso: $cursos";
    }
    
});*/

