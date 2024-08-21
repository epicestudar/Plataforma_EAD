<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatriculaController extends Controller
{
    public function add(Curso $curso) {
        // $matricula = Matricula::create(['aluno_id' => Auth::id(), 'curso_id' => $curso->id]);

        // return redirect()->route('cursos.show', $matricula->id)->with('success', 'Matrícula adicionado ao curso.');
    }
}
