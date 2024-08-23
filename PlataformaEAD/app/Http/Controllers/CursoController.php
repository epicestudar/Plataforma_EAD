<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtém o ID do professor logado
        $professorId = Auth::id();

        // Filtra os cursos pelo ID do professor logado
        $cursos = Curso::where('professor_id', $professorId)->get();

        // Retorna a view com os cursos filtrados
        return view('cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Adiciona log para depuração
    Log::info('Método Create Chamado');

    return view('cursos.create');
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Valida os dados de entrada
    $dados = $request->validate([
        'titulo' => 'required|max:100',
        'descricao' => 'required',
        'categoria' => 'required',
    ]);

    // Adiciona o ID do professor logado aos dados do curso
    $dados['professor_id'] = Auth::id();

    // Adiciona log para depuração
    Log::info('Dados do Curso a ser Criado:', $dados);

    // Cria o curso com os dados validados
    Curso::create($dados);

    return redirect()->route('cursos.index')
        ->with('success', 'Curso criado com sucesso.');
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        return view('cursos.edit', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        // Valida os dados de entrada
        $dados = $request->validate([
            'titulo' => 'required|max:100',
            'descricao' => 'required',
            'categoria' => 'required',
        ]);

        // Atualiza o curso com os dados validados, sem alterar o professor_id
        $curso->update($dados);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        // Deleta o curso
        $curso->delete();

        return redirect()->route('cursos.index')
            ->with('success', 'Curso deletado com sucesso.');
    }

    /**
     * Show the details of a specific course.
     */
    public function show(Curso $curso)
{
    // Adiciona log para depuração
    Log::info('ID do Curso no Método Show:', ['curso_id' => $curso->id]);

    // Carrega as informações do professor associado ao curso
    $curso->load('professor');

    // Verifica se o usuário autenticado já está matriculado neste curso
    $usuario = Auth::user();
    $jaMatriculado = Matricula::where('aluno_id', $usuario->id)
                              ->where('curso_id', $curso->id)
                              ->exists();

    // Adiciona log para depuração
    Log::info('Status de Matrícula do Usuário:', ['jaMatriculado' => $jaMatriculado]);

    return view('cursos.show', compact('curso', 'jaMatriculado'));
}



    public function alunos(Curso $curso)
{
    // Carrega as matrículas e os alunos associados ao curso
    $curso->load('inscricoes.aluno');

    // Verifica se o usuário autenticado é o professor deste curso
    $usuario = Auth::user();
    if ($usuario->id !== $curso->professor_id) {
        return redirect()->route('cursos.index')->with('error', 'Você não tem permissão para ver os alunos deste curso.');
    }

    return view('cursos.alunos', compact('curso'));
}

public function meusCursos()
{
    // Obtém o usuário autenticado
    $usuario = Auth::user();

    // Verifica se o usuário é um aluno
    if ($usuario->tipo !== 'aluno') {
        return redirect()->route('dashboard')->with('error', 'Apenas alunos podem acessar esta página.');
    }

    // Obtém os cursos em que o aluno está matriculado
    $cursos = Curso::whereHas('inscricoes', function ($query) use ($usuario) {
        $query->where('aluno_id', $usuario->id);
    })->get();

    // Retorna a view com os cursos matriculados
    return view('cursos.matriculados', compact('cursos'));
}


}