<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatriculaController extends Controller
{
    public function add(Curso $curso) {
        $matricula = new Matricula();
        $matricula->aluno_id = Auth::id();
        $matricula->curso_id = $curso->id;
        $matricula->data_matricula = now(); // Preenche a data de matrícula com a data atual
        $matricula->status = 'pendente';
        $matricula->save();

        return redirect()->route('cursos.show', $curso->id)->with('success', 'Matrícula realizada com sucesso.');
    }
}
