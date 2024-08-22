@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Alunos Matriculados no Curso: {{ $curso->titulo }}</h1>

        <a class="btn btn-secondary mb-3" href="{{ route('cursos.index') }}">Voltar</a>

        @if ($curso->inscricoes->isEmpty())
            <p>Nenhum aluno está matriculado neste curso.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Data de Matrícula</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($curso->inscricoes as $inscricao)
                        <tr>
                            <td>{{ $inscricao->aluno->nome }}</td>
                            <td>{{ $inscricao->aluno->email }}</td>
                            <td>{{ $inscricao->data_matricula }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
