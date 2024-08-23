@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="h2">Meus Cursos Matriculados</h1>

        @if($cursos->isEmpty())
            <p class="mt-4">Você ainda não está matriculado em nenhum curso.</p>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Título</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cursos as $curso)
                            <tr>
                                <td>{{ $curso->titulo }}</td>
                                <td>{{ $curso->categoria }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($curso->descricao, 100) }}</td>
                                <td>
                                    <a href="{{ route('cursos.show', $curso->id) }}" class="btn btn-primary">Ver Curso</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
