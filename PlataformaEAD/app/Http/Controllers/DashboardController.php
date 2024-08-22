<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');

        // Obtém o ID do professor logado
        $professorId = Auth::id();

        $cursos = Curso::when($search, function($query, $search) {
            $search = strtolower($search); // Convertendo o termo de busca para minúsculas
            return $query->whereRaw('LOWER(titulo) LIKE ?', ["%{$search}%"])
                         ->orWhereRaw('LOWER(descricao) LIKE ?', ["%{$search}%"])
                         ->orWhereRaw('LOWER(categoria) LIKE ?', ["%{$search}%"]);
        })->where('professor_id', '!=', $professorId) // Filtra cursos que não foram criados pelo professor logado
          ->get();

        return view('usuarios.dashboard', compact('cursos'));
    }
}
