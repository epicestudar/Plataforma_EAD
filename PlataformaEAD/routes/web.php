<?php

use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\MatriculaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VagaController;
use App\Http\Middleware\CursoMiddleware;
use App\Http\Middleware\VagaMiddleware;

// Rota para exibir o formulário de login
Route::get('/login', [UsuarioController::class, 'formularioLogin'])->name('usuarios.login.form');

// Rota para processar o login
Route::post('/login', [UsuarioController::class, 'logicaLogin'])->name('usuarios.login');

// Rota para exibir o formulário de registro
Route::get('/cadastro', [UsuarioController::class, 'formularioCadastro'])->name('usuarios.cadastro.form');

// Rota para processar o registro
Route::post('/cadastro', [UsuarioController::class, 'logicaCadastro'])->name('usuarios.cadastro');

// Rota para logout
Route::post('/logout', [UsuarioController::class, 'logout'])->name('usuarios.logout');

// Rota para a página inicial
Route::get('', [HomeController::class, 'index'])->name('home');

// Rota para o dashboard, protegida por autenticação
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Rota para exibir os alunos de um curso específico (antes das rotas de recurso para evitar conflitos)
Route::get('cursos/{curso}/alunos', [CursoController::class, 'alunos'])->middleware('auth')->name('cursos.alunos');

// Rota para a matrícula em um curso
Route::post('matricula/add/{curso}', [MatriculaController::class, 'add'])->middleware('auth')->name('matricula.add');

// Rota para exibir os cursos nos quais o usuário está matriculado
Route::get('/meus-cursos', [CursoController::class, 'meusCursos'])->middleware('auth')->name('cursos.matriculados');

// Defina as rotas de recurso para 'cursos' (deixe por último para evitar conflitos com as rotas acima)
Route::resource('/cursos', CursoController::class)->middleware(CursoMiddleware::class)->except('show');

// Rota para exibir o curso específico (verifique se o padrão da URL não está conflitando com a rota de recurso)
Route::get('cursos/{curso}', [CursoController::class, 'show'])->middleware('auth')->name('cursos.show');
