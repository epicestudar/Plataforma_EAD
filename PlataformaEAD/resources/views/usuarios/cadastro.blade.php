@extends('layouts.app')

@section('content')
    {{-- formulario --}}
    <div class="container">
        <h1>Registrar-se</h1>
        <form method="POST" action="{{ route('usuarios.cadastro') }}">
            @csrf

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" name="cidade" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="data_nascimento">Data de nascimento</label>
                <input type="date" name="data_nascimento" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo de usuário:</label>
                <select class="form-control" id="tipo" name="tipo">
                    <option value="aluno">Aluno</option>
                    <option value="docente">Docente</option>
                </select>
            </div>

            <div class="form-group" id="cpf-group" style="display: none;">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" class="form-control">
            </div>

            <div class="form-group" id="nome_curso-group" style="display: none;">
                <label for="nome_curso">Nome do Curso</label>
                <input type="text" name="nome_curso" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirme a Senha</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar-se</button>
        </form>
    </div>

    
@endsection