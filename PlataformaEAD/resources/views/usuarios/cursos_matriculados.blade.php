@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="h2">Cursos Matriculados</h1>

        

        <div class="row">
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
