<?php

use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InscricaoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VagaController;
use App\Http\Middleware\CursoMiddleware;
use App\Http\Middleware\VagaMiddleware;

// Rota para exibir o formulário de login
Route::get('/login', [UsuarioController::class, 'formularioLogin'])->
name('usuarios.login.form');

Route::get('', [HomeController::class, 'index'])->name('home');


// Rota para processar o login
Route::post('/login', [UsuarioController::class, 'logicaLogin'])->
name('usuarios.login');


// Rota para exibir o formulário de registro
Route::get('/cadastro', [UsuarioController::class, 'formularioCadastro'])->
name('usuarios.cadastro.form');


// Rota para processar o registro
Route::post('/cadastro', [UsuarioController::class, 'logicaCadastro'])->
name('usuarios.cadastro');


// Rota para logout
Route::post('/logout', [UsuarioController::class, 'logout'])->
name('usuarios.logout');

// Rota para o dashboard, protegida por autenticação
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::resource('/cursos', CursoController::class)->middleware(CursoMiddleware::class)->except('show');

Route::get('cursos/{curso}', [CursoController::class, 'show'])->middleware('auth')->name('cursos.show');