<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');

        $cursos = Curso::when($search, function($query, $search) {
            $search = strtolower($search); // Convertendo o termo de busca para minúsculas
            return $query->whereRaw('LOWER(titulo) LIKE ?', ["%{$search}%"])
                         ->orWhereRaw('LOWER(descricao) LIKE ?', ["%{$search}%"])
                         ->orWhereRaw('LOWER(categoria) LIKE ?', ["%{$search}%"]);
        })->get();

        return view('usuarios.dashboard', compact('cursos'));
    }
}
