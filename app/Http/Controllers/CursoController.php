<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Models\Cuestionarios;
use App\Models\Preguntas;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function Pest\Laravel\json;

class CursoController extends Controller
{
    public function index()
    {
        try {
            $cursos = Curso::orderBy('id', 'desc')->paginate();

            return view('cursos.index', compact('cursos'));
        } catch (\Exception $e) {
            Log::error('Error al obtener los cursos: ' . $e->getMessage());
            return response()->json()->route('cursos.index')->withErrors('Error al cargar los cursos.');
        }
    }

    public function create()
    {

        return view('cursos.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
                'categoria' => 'required|string|max:255',
            ]);

            return DB::transaction(function () use ($request) {
                $curso = new Curso();
                $curso->name = $request->name;
                $curso->description = $request->description;
                $curso->categoria = $request->categoria;

                $curso->save();
                return redirect()->route('cursos.show', $curso->id);
            });
            //return redirect()->route('cursos.show', $curso);
        } catch (ValidationException $e) {
            Log::error('' . json_encode($e->errors()));

            return redirect()->back()->with('error', '');
        } catch (Exception $e) {
            LOG::ERROR('' . $e->getMessage());
            return redirect()->back()->with('error');
        }
    }

    public function guardarCuestionario(Request $request, $id)
    {
        try {
            $request->validate([
                'titulo' => 'required|string|max:255',
                'pregunta' => 'required|string|max:1000',
            ]);
            DB::transaction(function () use ($request, $id) {
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
            });
            //return redirect()->route('cursos.show', $curso->id)->with('success', 'Cuestionario guardado exitosamente.');

            return response()->json([
                'message' => 'Mensaje de éxito'
            ], 200);
        } catch (ValidationException $e) {
            Log::error('' . json_encode($e->errors()));

            return response()->json([
                'message' => 'Mensaje de error'
            ], 500);
        } catch (Exception $e) {
            LOG::ERROR('' . $e->getMessage());
            return response()->json([
                'message' => 'Mensaje de error'
            ], 500);
        }
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

    public function modPregunta($id, Request $request)
    {
        try {

            $request->validate([
                'id' => 'required|integer|exists:cursos,id',
            ]);
            DB::transaction(function () use ($request, $id) {
                $curso = Curso::with(['cuestionarios'])->find($id);
                $cuestionario = $curso->cuestionarios()->firstOrFail();
                $pregunta = Preguntas::where('cuestionario_id', $cuestionario->id)->firstOrFail();
            });


            //Log::info($curso);
        } catch (ValidationException $e) {
            Log::error('' . json_encode($e->errors()));

            return response()->json([
                'message' => 'Mensaje de éxito'
            ], 200);
        } catch (Exception $e) {
            LOG::ERROR('' . $e->getMessage());
            return response()->json([
                'message' => 'Mensaje de éxito'
            ], 200);
        }


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

    public function update(Request $request, $pregunta)
    {
        try {
            DB::transaction(function () use ($request, $pregunta) {
                // Validación
                Log::info($pregunta);
                log::info($request->all());
                $pregunta = Preguntas::findOrFail($pregunta);
                $request->validate(['texto' => 'required|string|max:255',]);

                // Actualizar con Eloquent
                $pregunta->pregunta = $request->texto;
                $pregunta->save();
            });
        } catch (ValidationException $e) {
            Log::error('' . json_encode($e->errors()));

            return redirect()->back()->with('error', '');
        } catch (Exception $e) {
            LOG::ERROR('' . $e->getMessage());
            return redirect()->back()->with('error', '');
        }

        // Redireccionar o responder
        return view('cursos.modCuestionario', ['curso' => $pregunta->cuestionario->curso, 'pregunta' => $pregunta]);
    }



    public function destroy($pregunta)
    {
        try {

            DB::transaction(function () use ($pregunta) {
                // Lógica para eliminar la pregunta


                $pregunta = Preguntas::findOrFail($pregunta);
                //Log::info('Eliminando pregunta: ' . $pregunta->id);
                $pregunta->delete();
                //Log::info('Pregunta eliminada: ' . $pregunta->id);

                $curso = $pregunta->cuestionario->curso;
                $cuestionario = $pregunta->cuestionario;
                if ($cuestionario && $cuestionario->preguntas()->count() === 0) {
                    Log::info('Eliminando cuestionario: ' . $cuestionario->id);
                    $cuestionario->delete();
                    Log::info('Cuestionario eliminado: ' . $cuestionario->id);
                }
            });
        } catch (ValidationException $e) {
            Log::error('' . json_encode($e->errors()));

            return redirect()->back()->with('error', '');
        } catch (Exception $e) {
            LOG::ERROR('' . $e->getMessage());
            return redirect()->back()->with('error', '');
        }
        // Redireccionar o responder

        return redirect()->route('cursos.index');

    }
}
