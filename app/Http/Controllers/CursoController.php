<?php

namespace App\Http\Controllers;
use App\Models\Cuestionarios;
use App\Models\Preguntas;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::orderBy('id','desc')->paginate();
 

        return view('cursos.index', compact('cursos'));
        // Si no necesitas las preguntas y cuestionarios, puedes eliminarlos de la consulta
        //return view('cursos.index', compact('cursos'));//
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request){
        $curso = new Curso();
        $curso -> name = $request -> name;
        $curso -> description = $request -> description;
        $curso -> categoria = $request -> categoria;

        $curso -> save();
        return redirect()->route('cursos.show', $curso);
    }

    public function guardarCuestionario(Request $request, $id)
    {
        // Lógica para guardar el cuestionario asociado al curso con ID $id
        $curso = Curso::find($id);
        $cuestionario = new Cuestionarios();
        $pregunta= new Preguntas();

        $cuestionario -> titulo = $request -> titulo;
        $cuestionario -> curso_id = $curso -> id;

        $cuestionario->save();

        $pregunta -> pregunta = $request -> pregunta;
        $pregunta -> cuestionario_id = $cuestionario -> id;
        // Ejemplo básico de redirección después de guardar
        $pregunta->save();

        return redirect()->route('cursos.index', $curso);
        
    }

    public function cuestionario($id)
    {
        $curso = Curso::find($id);
        return view('cursos.cuestionario', compact('curso'));
    }

    public function show($id)
    {
        $curso = Curso::with(['cuestionarios'])->find($id);

        Log::info($curso);
       

        return view('cursos.show',compact('curso'));
    }
}
