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
        $cursos = Curso::orderBy('id', 'desc')->paginate();


        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        $curso = new Curso();
        $curso->name = $request->name;
        $curso->description = $request->description;
        $curso->categoria = $request->categoria;

        $curso->save();
        return redirect()->route('cursos.show', $curso);
    }

    public function guardarCuestionario(Request $request, $id)
    {
        // Lógica para guardar el cuestionario asociado al curso con ID $id
        $curso = Curso::find($id);
        $cuestionario = new Cuestionarios();
        $pregunta = new Preguntas();

        $cuestionario->titulo = $request->titulo;
        $cuestionario->curso_id = $curso->id;

        $cuestionario->save();

        $pregunta->pregunta = $request->pregunta;
        $pregunta->cuestionario_id = $cuestionario->id;
        // Ejemplo básico de redirección después de guardar
        $pregunta->save();

        //return redirect()->route('cursos.show', $curso->id)->with('success', 'Cuestionario guardado exitosamente.');

        return response()->json([
            'message' => 'Mensaje de éxito'
        ], 200);
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


        return view('cursos.show', compact('curso'));
    }

    public function modCuestionario($id)
    {
        $curso = Curso::with(['cuestionarios'])->find($id);

        Log::info($curso);


        return view('cursos.modCuestionario', compact('curso'));
    }

    public function modPregunta($id)
    {
        $curso = Curso::with(['cuestionarios'])->find($id);
        $cuestionario = $curso->cuestionarios()->firstOrFail();
        $pregunta = Preguntas::where('cuestionario_id', $cuestionario->id)->firstOrFail();

        Log::info($curso);


        return view('cursos.modPregunta', compact('curso', 'pregunta'));
    }

    /*public function updateCuestionario(Request $request, $id)
    {
        $cuestionario = Cuestionarios::find($id);
        if (!$cuestionario) {
            return response()->json(['message' => 'Cuestionario no encontrado'], 404);
        }

        $cuestionario->titulo = $request->titulo;
        $cuestionario->save();

        return response()->json(['message' => 'Cuestionario actualizado exitosamente'], 200);
    }*/

    public function update(Request $request,$pregunta)
    {
        // Validación
        Log::info($pregunta);
        log::info($request->all());
        $pregunta = Preguntas::findOrFail($pregunta);
        $request->validate(['texto' => 'required|string|max:255',]);

        // Actualizar con Eloquent
        $pregunta->pregunta = $request->texto;
        $pregunta->save();

        // Redireccionar o responder
        return view('cursos.modCuestionario', ['curso' => $pregunta->cuestionario->curso,'pregunta' => $pregunta]);
    }


    
    public function destroy($pregunta){

        $pregunta = Preguntas::findOrFail($pregunta);
        Log::info('Eliminando pregunta: ' . $pregunta->id);
        $pregunta->delete();
        Log::info('Pregunta eliminada: ' . $pregunta->id);

        // Redireccionar o responder

        return redirect()->route('cursos.index');

    }
}
