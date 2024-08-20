<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');
        $cursos = Curso::when($search, function($query, $search) {
            return $query->where('titulo', 'like', "%{$search}%")
                         ->orWhere('descricao', 'like', "%{$search}%")
                         ->orWhere('categoria', 'like', "%{$search}%");
        })->get();

        return view('usuarios.dashboard', compact('cursos'));
    }
}