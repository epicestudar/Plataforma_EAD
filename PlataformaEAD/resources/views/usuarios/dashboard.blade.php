@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Dashboard de Cursos</h1>

        @if (auth()->user()->isDocente())
            <a href="/cursos" class="btn btn-success">Página Interna do Docente</a>
        @else
            <a href="{{ route('cursos.matriculados') }}" class="btn btn-primary">Meus Cursos</a>
        @endif
    </div>

    <form method="GET" action="{{ route('dashboard') }}" class="d-flex mb-4">
        <input type="search" name="search" class="form-control me-2" placeholder="Pesquisar cursos..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-outline-primary">Pesquisar</button>
    </form>

    <div class="row g-4">
        @foreach ($cursos as $curso)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <img src="/assets/img/img1.png" class="card-img-top" alt="{{ $curso->titulo }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $curso->titulo }}</h5>
                        <p class="text-muted mb-2">{{ $curso->categoria }}</p>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($curso->descricao, 100) }}</p>
                        <a href="{{ route('cursos.show', $curso->id) }}" class="btn btn-primary mt-auto">Ver Curso</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection